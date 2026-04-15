<?php

namespace App\Traits\Http;


use Illuminate\Support\Facades\Http;

trait HttpTrait{
    protected string $_url = 'http://localhost:1880';

    /**
     * @return mixed
     * Get an IP ADDR from HTTP Request
     */
    protected function getIp(): mixed{
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    /**
     * Create http request to Node-Red
     * @param $address
     * @param $dpt
     * @param $value
     * @return mixed
     */
    public function httpToKNX($address, $dpt, $value): mixed{
        return Http::post($this->_url . '/knx/light', [
            'ga' => $address,
            'dpt' => $dpt,
            'value' => $value
        ]);
    }
}
