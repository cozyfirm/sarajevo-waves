<?php

namespace App\Http\Controllers\System\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Hotel\Rooms\Light;
use App\Models\Hotel\Rooms\Room;
use App\Traits\Common\LogTrait;
use App\Traits\Http\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoomsController extends Controller{
    use ResponseTrait, LogTrait;
    protected string $_path = 'system/app/hotel/rooms/';

    /**
     * Main rooms dashboard
     * @return View
     */
    public function dashboard(): View{
        return view($this->_path . 'dashboard', [
            'rooms' => Room::get()
        ]);
    }

    /**
     * Preview single room:
     *  - reservations
     *  - devices
     * @param $id
     * @return View
     */
    public function preview($id): View{
        $room = Room::where('id', '=', $id)->first();

        return view($this->_path . 'preview', [
            'room' => $room,
            'sosActive' => true,
            'floodActive' => true,
            'lights' => Light::where('room_id', '=', $room->id)->get()
        ]);
    }
}
