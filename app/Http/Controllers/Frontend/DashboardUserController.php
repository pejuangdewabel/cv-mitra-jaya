<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Kategori;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function dashboard()
    {
        return view('frontend.pages.dashboard.index');
    }
}
