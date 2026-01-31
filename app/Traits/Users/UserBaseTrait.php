<?php
namespace App\Traits\Users;

use App\Models\User;
use App\Models\Users\SystemAccess;
use Illuminate\Support\Facades\Log;

trait UserBaseTrait{
    /**
     * Total numbers of users with that exact username
     * @param $username
     * @return string
     */
    protected function usersByUsername($username) : string{
        try{
            $total = User::where('username', '=', $username)->count();
            if($total == 0) return '';
            else return $total;
        }catch (\Exception $e){ return ''; }
    }

    /**
     * Compose slug from string (name)
     * @param $slug
     * @return string
     */
    public function composeSlug($slug): string {
        $slug = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $slug);
        $slug = iconv('UTF-8', 'ISO-8859-1//IGNORE', $slug);
        $slug = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $slug);

        $string = str_replace(array('[\', \']'), '', $slug);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
        $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
        return strtolower(trim($string, '-'));
    }

    /**
     * Finally, compose username from name
     * @param $slug
     * @return string
     */
    public function getSlug($slug): string{
        $string = $this->composeSlug($slug);
        return ($string . ($this->usersByUsername($string)));
    }


    /**
     * Log user action; Failed login or success
     * @param $user
     * @param $action
     * @param $description
     * @return void
     */
    public function logAction($user, $action, $description): void{
        try{
            $access = SystemAccess::create([
                'user_id' => $user->id,
                'action' => $action,
                'description' => $description,
                'user_agent'  => request()->userAgent(),
                'ip_address'  => request()->ip()
            ]);

            /**
             *  Broadcast over MQTT; ToDo:: Make this work!!
             */
            try{
//                foreach ($this->getAdmins() as $admin) {
//                    $this->publishMessage('system-access', $admin->api_token, '0000', [
//                        'action' => $action,
//                        'description' => $description,
//                        'date' => $access->dateTime(),
//                        'username' => $user->username,
//                        'initials' => $user->getInitials(),
//                        'name' => $user->name,
//                        'classname' => ($access->action == 'sign-in') ? 'fa-right-to-bracket' : 'fa-power-off'
//                    ]);
//                }
            }catch (\Exception $e){
                Log::info("UserBaseTrait::logAction() Error while broadcasting action");
            }
        }catch (\Exception $e){
            Log::info("UserBaseTrait::logAction() Error while logging action");
        }
    }
}
