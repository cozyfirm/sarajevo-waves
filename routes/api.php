<?php

use App\Http\Controllers\API\KNX\EventsController;
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
