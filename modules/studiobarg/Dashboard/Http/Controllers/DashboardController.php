<?php

namespace studiobarg\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function home(){
        return view('Dashboard::index');
    }
}
