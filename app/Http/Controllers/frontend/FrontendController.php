<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
     public function dashboard()
    {
        return view('frontend.dashboard.index');
    }
}
