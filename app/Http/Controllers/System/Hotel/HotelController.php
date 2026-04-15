<?php

namespace App\Http\Controllers\System\Hotel;

use App\Http\Controllers\Controller;
use App\Traits\Common\LogTrait;
use App\Traits\Http\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HotelController extends Controller{
    use ResponseTrait, LogTrait;
    protected string $_path = 'system/app/hotel/';

    public function dashboard(): View{
        return view($this->_path . 'dashboard');
    }
}
