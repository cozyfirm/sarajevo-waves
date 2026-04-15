<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Hotel\Rooms\Light;
use App\Traits\Common\LogTrait;
use App\Traits\Http\HttpTrait;
use App\Traits\Http\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LightsAPIController extends Controller{
    use ResponseTrait, LogTrait, HttpTrait;

    /**
     * Set light status (On-Off mode)
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function setStatus(Request $request): JsonResponse{
        try{
            $status = ($request->status == '0') ? 0 : 1;

            // Make an opposite action from current action
            $response = $this->httpToKNX($request->address, '1.001', ($status) ? 'off' : 'on');

            if($response->status() === 200){
                // Make an opposite value
                $status = ($status == '1') ? 0 : 1;

                // Update light status
                Light::where('id', '=', $request->id)->update(['status' => $status]);

                return $this->apiResponse('0000', __('Uspješno ažurirano'), ['status' => $status]);
            }else{
                return $this->jsonError('1500', __('Greška u komunikaciji sa uređajem!'));
            }
        }catch (\Exception $e){
            return $this->jsonError('1500', __('Greška prilikom procesiranja podataka. Molimo da nas kontaktirate!'));
        }
    }
}
