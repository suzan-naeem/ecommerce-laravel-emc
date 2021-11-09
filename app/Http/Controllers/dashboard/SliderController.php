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
        // $singleSlider =  Slider::create( $request->all());
        // $singleImag = Upload::uploadImage($request->file('image'), 'slider');

        $singleImag = Upload::uploadImage($request->file('image'), 'slider');

        DB::table('sliders')->insert([
            'image'         => $singleImag,
            'display'       => $request->display,
            // 'display'       => $request->get('display'),
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
 
        ]);
        return redirect()->back()->with('success', __('messages.imageAddedSuccessfully'));

    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

  
    public function update(Request $request, $id)
    {
        //
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
