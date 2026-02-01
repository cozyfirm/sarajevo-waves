<?php

namespace App\Http\Controllers\System\Settings;

use App\Http\Controllers\Controller;
use App\Models\Users\SystemAccess;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller{
    protected string $_path = 'system/app/settings/';

    public function home(): View{
        return view($this->_path . 'home', [
            'systemAccess' => SystemAccess::orderBy('id', 'DESC')->take(5)->get(),
        ]);
    }
}
