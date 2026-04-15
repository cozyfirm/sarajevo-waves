<?php

namespace App\Http\Controllers\API\KNX;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventsController extends Controller{

    /**
     * Get all events from KNX network
     * @param Request $request
     * @return JsonResponse
     */

    public function get(Request $request): JsonResponse{
        try {
            Log::info('KNX EVENT', [
                'data' => $request->all()
            ]);

            return response()->json([
                'status' => 'ok'
            ]);
        } catch (\Exception $e) {
            Log::error('KNX ERROR', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status' => 'error'
            ], 500);
        }
    }
}
