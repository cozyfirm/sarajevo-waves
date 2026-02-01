<?php

namespace App\Http\Controllers\System\Users;

use App\Http\Controllers\Controller;
use App\Services\Users\TwoFA\TwoFAService;
use App\Traits\Http\ResponseTrait;
use App\Traits\Users\UserBaseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TwoFAController extends Controller{
    use UserBaseTrait, ResponseTrait;
    protected string $_path = 'system/app/users/my-profile/two-fa/';

    /**
     * Enable / Disable 2FA
     * @return View
     */
    public function home(): View{
        return view($this->_path . 'home');
    }

    /**
     * Setup 2FA
     * @return View
     */
    public function setup(): View{
        // Get 32 chars length secret
        $secret = TwoFAService::generateSecret();

        $issuer = config('app.name');   // Unique for every APP
        $email  = auth()->user()->email;

        // Generate otpAuth
        $otpAuth = "otpauth://totp/{$issuer}:{$email}?secret={$secret}&issuer={$issuer}&period=30&digits=6";

        // Generate QR Code
//        $qr = base64_encode(
//            QrCode::format('svg')->size(200)->generate($otpAuth)
//        );
//        // Get QR Code as image
//        $qrCode = "data:image/png;base64,$qr";

        $qrCode = QrCode::format('svg')->size(200)->generate($otpAuth);

        return view($this->_path . 'setup', [
            'secret' => $secret,
            'qrCode' => $qrCode
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function activate(Request $request): JsonResponse{
        try{
            if(!isset($request->code)) return $this->jsonError('1551', __('Molimo da unesete kod!'));
            if(!isset($request->secret)) return $this->jsonError('1551', __('Greška sa ključem. Molimo pokušajte ponovo!'));

            if(!TwoFAService::verifyCode($request->secret, $request->code)){
                return $this->jsonError('1553', __('Validacija nije uspjela!'));
            }

            Auth::user()->update([
                'two_fa' => true,
                'two_fa_secret' => Crypt::encryptString($request->secret)
            ]);

            return $this->jsonSuccess(__('Uspješno postavljen 2FA!'), route('system.dashboard'));
        }catch (\Exception $e){
            return $this->jsonError('1550', __('Greška prilikom procesiranja podataka. Molimo da nas kontaktirate!'));
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deactivate(Request $request): JsonResponse{
        try{
            if(!isset($request->state)) return $this->jsonError('1561', __('Greška!'));
            Auth::user()->update(['two_fa' => false, 'two_fa_secret' => null]);

            return $this->jsonSuccess(__('2FA uspješno ugašen!'));
        }catch (\Exception $e){
            return $this->jsonError('1560', __('Greška prilikom procesiranja podataka. Molimo da nas kontaktirate!'));
        }
    }
}
