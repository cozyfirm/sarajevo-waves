<?php

use App\Http\Controllers\API\KNX\EventsController;
use App\Http\Controllers\API\LightsAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
});


/**
 *  Fetch all events from KNX network;
 *      - listen and receive all telegrams
 */
Route::prefix('/knx-network')->group(function (){

    Route::prefix('/events')->group(function (){
        Route::post('/',                              [EventsController::class, 'get'])->name('api.knx-network.events');
    });
});

/**
 *  Hotel API system:
 *      - Rooms:
 *          1. Lights
 *          2. VRF
 *          3. Statuses
 *      -
 */
Route::prefix('/hotel')->group(function (){
    /** Rooms */
    Route::prefix('/rooms')->group(function (){
        /** Lights */
        Route::prefix('/lights')->group(function (){
            Route::post('/set-status',                  [LightsAPIController::class, 'setStatus'])->name('api.hotel.lights');
        });
    });
});
