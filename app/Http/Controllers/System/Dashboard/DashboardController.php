<?php

namespace App\Http\Controllers\System\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Users\SystemAccess;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller{
    protected string $_path = 'system/app/dashboard/';

    /**
     * Main dashboard
     * @return View
     */
    public function home(): View{
        return view($this->_path . 'home', [
            'systemAccess' => SystemAccess::orderBy('id', 'DESC')->take(5)->get(),
        ]);
    }
}
