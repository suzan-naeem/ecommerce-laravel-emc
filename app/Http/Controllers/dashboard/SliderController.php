<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Upload;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.slider.index', ['sliders' => Slider::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.slider.create');
    }

    
    public function store(Request $request)
    {

        $singleImag = Upload::uploadImage($request->file('image'), 'slider');
        //'http://127.0.0.1:8000/uploads/slider/1636533450.jpg'

        $singleSlider = new Slider();
        $singleSlider->image = $singleImag;
        $singleSlider->display = $request->display;
        $singleSlider->save();

        return redirect()->back()->with('success', __('messages.imageAddedSuccessfully'));

     

    }


    
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        Upload::deleteImage($slider->image, 'slider');
        $slider->delete();
        return redirect()->back()->with('success', __('messages.imageDeletedSuccessfully'));
       
    }

    public function switch(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->display = $request->display;
        $slider->save();


        // $slider = Slider::findOrFail(request('id'));
        // $slider->display = request('display');
        // $slider->save();
    }


}
