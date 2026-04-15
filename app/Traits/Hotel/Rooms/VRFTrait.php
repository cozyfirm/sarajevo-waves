<?php

namespace App\Traits\Hotel\Rooms;

use App\Models\Core\File;
use Illuminate\Http\Request;

trait VRFTrait{
    /**
     * @param Request $request
     * @return bool
     */
    public function updateVRFStatus(Request $request): bool{
        try{

            return true;
        }catch (\Exception $e){
            return false;
        }
    }
}
