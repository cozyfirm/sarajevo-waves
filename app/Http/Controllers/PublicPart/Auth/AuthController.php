<?php

namespace App\Http\Controllers\PublicPart\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Users\RestartPassword;
use App\Models\Core\Country;
use App\Models\User;
use App\Models\Users\RestartToken;
use App\Traits\Common\LogTrait;
use App\Traits\Http\ResponseTrait;
use App\Traits\Users\UserBaseTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AuthController extends Controller{
    use UserBaseTrait, ResponseTrait, LogTrait;
    protected string $_path = 'public-part.auth.';

    /**
     * Return Auth view
     * @return View
     */
    public function auth(): View{
        return view($this->_path. 'auth');
    }

    /**
     * Authenticate user and regenerate session
     * @param Request $request
     * @return JsonResponse
     */
    public function authenticate(Request $request): JsonResponse{
        try{
            if(empty($request->email)) return $this->jsonError('1101',  __('Unesi svoj email'));
            if(empty($request->password)) return $this->jsonError('1102',  __('Unesi svoju šifru'));

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                // Regenerate new session at auth attempt (Used for sanctum)
                $request->session()->regenerate();
                // Login user
                $user = Auth::user();

                $route = route('public.home');
                // if($user->role == 'admin') $route = route('system.home');

                // Log user action
                $this->logAction($user, 'sign-in', __('Prijava na sistem'));

                return $this->jsonSuccess(__('Prijava uspješna!'), $route);
            }else {
                return $this->jsonError('1103',  __('Pogrešni pristupni podaci'));
            }
        }catch (\Exception $e){
            $this->write('AuthController::authenticate()', $e->getCode(), $e->getMessage(), $request);
            return $this->apiResponse('1100', __('Greška prilikom obrade zahtjeva. Molimo prijavi grešku!'));
        }
    }

    /**
     * @return RedirectResponse
     * Destroy sessions and log user out
     */
    public function logout(): RedirectResponse{
        try{
            /** Create new sample for logout */
            $this->logAction(Auth::user(), 'sign-out', __('Odjava sa sistema'));

            /** Logout user; Remove session from DB; Has to be done before new token creating */
            Auth::logout();
        }catch (\Exception $e){
            $this->write('AuthController::logout()', $e->getCode(), $e->getMessage());
        }

        // Redirect to auth route
        return redirect()->route('auth');
    }

    /* -------------------------------------------------------------------------------------------------------------- */
    /*
     *  Register Form
     */

    /**
     * Return view for account creation
     * @return View
     */
    public function createAccount(): View{
        return view($this->_path. 'create-account', [
            'prefixes' => Country::orderBy('phone_code')->get()->pluck('phone_code', 'id'),
            'countries' => Country::orderBy('name_ba')->get()->pluck('name_ba', 'id'),
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * Ajax END-Point; Create new profile
     */
    public function saveAccount(Request $request): JsonResponse{
        try{
            if(!isset($request->name)) return $this->apiResponse('1021', __('Unesi ime'));
            if(!isset($request->email)) return $this->apiResponse('1022', __('Neispravna email adresa'));
            if(!isset($request->password)) return $this->apiResponse('1023', __('Neispravano šifra'));

            $email = trim($request->email);
            // Validate email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return $this->apiResponse('1024', __('Format email adrese nije validan'));

            // Check if email already exists in the database
            $user = User::where('email', '=', $email)->first();
            if ($user) return $this->apiResponse('1025', __('Odabrani email se već koristi'));

            // Hash password and create api_token
            $request['password'] = Hash::make($request->password);
            $request['api_token'] = hash('sha256', $request->email. '+'. time());
            $request['username'] = $this->getSlug($request->name);

            // Create new user
            $user = User::create($request->all());

            // Auto login
            Auth::login($user);

            return $this->apiResponse('0000', __('Korisnički Račun uspješno kreiran!'), [
                'url' => route('public.home')
            ]);
        }catch (\Exception $e){
            $this->write('AuthController::saveAccount()', $e->getCode(), $e->getMessage(), $request);
            return $this->apiResponse('1020', __('Greška prilikom obrade zahtjeva. Molimo prijavi grešku!'));
        }
    }


    /**
     * Verify email; Update email_verified_at and send an email
     *
     * @param $token
     * @return RedirectResponse
     */
    public function verifyAccount($token): RedirectResponse{
        try{
            $user = User::where('api_token', '=', $token)->first();
            // $user->notify(new SystemNotifications());

            $user->update(['email_verified_at' => Carbon::now()]);

            // Create welcome notification to user
            if (!$user->notifications()->where('data->type', 'welcome')->exists()) {
                // Prevent double welcome messages
                // $user->notify(new SystemNotifications('welcome', 'Vaš korisnički račun je uspješno kreiran. Sada možete učestvovati u diskusijama na Forumu "Reprezentacija.ba" !'));
            }

            Auth::login($user);
        }catch (\Exception $e){ }
        return redirect()->route('public.home');
    }

    /* -------------------------------------------------------------------------------------------------------------- */
    /*
     *  Restart password methods
     */

    /**
     * Account recovery mechanism; Send email with token and confirm email recovery
     * @return View
     */
    public function recoveryAccount(): View{
        return view($this->_path. 'recovery-account');
    }

    public function recoveryAccountSuccess(): View{
        return view($this->_path. 'recovery-account-success');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * Post method to generate new restart_password token
     */
    public function generateRestartToken(Request $request): JsonResponse{
        try{
            /* Delete previous tokens */
            RestartToken::where('email', '=', $request->email)->delete();

            $token = RestartToken::create(['email' => $request->email, 'token' => md5(time())]);
            $user  = User::where('email', '=', $request->email)->first();

            /* Set email with instructions */
            Mail::to($request->email)->send(new RestartPassword($user->email, $user->name, $token->token));

            return $this->apiResponse('0000', __('Detaljne upute za oporavak računa su poslane na email adresu'), [
                'url' => route('auth.account-recovery-success')
            ]);
        }catch (\Exception $e){
            return $this->apiResponse('1131', __('Greška prilikom procesiranja podataka. Molimo da nas kontaktirate!'));
        }
    }

    /**
     * @param $token
     * @return View
     *
     * Offer user option to insert new password
     */
    public function newPassword($token): View{
        return view($this->_path. 'new-password', [
            'token' => $token
        ]);
    }

    /**
     * Generate new password
     * @param Request $request
     * @return JsonResponse
     */
    public function generateNewPassword(Request $request): JsonResponse{
        try{
            if(!isset($request->email)) return $this->jsonError('1142', __('Molimo da unesete Vaš email'));
            if(!isset($request->password)) return $this->jsonError('11413', __('Unesite Vašu šifru'));

            // if($request->password != $request->repeat) return $this->jsonResponse('11415', __('Unesene šifre se ne podudaraju!'));

            /* Get sample from DB */
            $token = RestartToken::where('email', '=', $request->email)->where('token', '=', $request->token)->first();

            /* Check if token is valid */
            if(!$token) return $this->jsonError('11416', __('Token nije važeći!'), ['url' => route('auth')]);

            /* Update user password */
            $user = User::where('email', '=', $request->email)->first();

            // Update new password
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            Auth::login($user);

            /* Remove token from DB; Query Again since there is no PK */
            RestartToken::where('email', '=', $request->email)->delete();

            return $this->jsonSuccess(__('Korisnička šifra uspješno izmijenjena!'), route('public.home'));
        }catch (\Exception $e){
            return $this->jsonError( '1141', __('Greška prilikom procesiranja podataka. Molimo da nas kontaktirate!'));
        }
    }
}
