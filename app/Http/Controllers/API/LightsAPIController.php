<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\Common\LogTrait;
use App\Traits\Http\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LightsAPIController extends Controller{
    use ResponseTrait, LogTrait;

    /**
     * Set light status (On-Off mode)
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function setStatus(Request $request): JsonResponse{
        try{
            dd($request->all());

            return $this->jsonSuccess(__('Uspješno spašeno'), route('system.admin.users.preview'));
        }catch (\Exception $e){
            return $this->jsonError('1500', __('Greška prilikom procesiranja podataka. Molimo da nas kontaktirate!'));
        }
    }
}
