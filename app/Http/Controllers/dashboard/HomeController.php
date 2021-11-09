<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
// use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliderCount            = Slider::all()->count();
        return view('dashboard.home.index',
            compact(
                'sliderCount',
            ));
    }
}
