<?php

namespace App\Http\Controllers\dashboard;

use App\Helper\Upload;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.category.index', ['categories' => Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.category.create');
    }

    public function store(CategoryRequest $request)
    {
        // $next_id = DB::select("SHOW TABLE STATUS LIKE 'categories'");
        // $next_id = $next_id[0]->Auto_increment;
        // $imageName = Upload::uploadImage($request->file('image'), 'categories/' . $next_id);
        //'http://127.0.0.1:8000/uploads/categories/1/1636534671.jpg'

        $category = new Category();
        $category->name_ar = $request->name_ar;
        $category->name_en = $request->name_en;
        $category->display = $request->display;
        $category->image = Upload::uploadImage($request->file('image'), 'categories');
        $category->save();
        // $id = $category->id;
        

        return redirect()->back()->with('success', __('messages.categoryAddedSuccessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.category.show',['category'=> $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $category = Category::find($id);
        return view('dashboard.category.edit',['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name_ar = $request->get('name_ar');
        $category->name_en = $request->get('name_en');
        $category->display = $request->get('display');
        if ($request->file('image')) {
            $category->image = Upload::uploadImage($request->file('image'),
                'categories/' . $category->id, $category['image']);
        }
        $category->save();
        return redirect()->back()->with('success', __('messages.categoryUpdatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $category = Category::findOrFail($id);
        if (!$category->products) {
            Upload::deleteDirectory('categories/' . $category->id);
            $category->delete();
            return redirect()->back()->with('success', __('messages.categoryDeletedSuccessfully'));
        } else {
            return redirect()->back()->with('danger', __('messages.categoryHasProducts'));
        }

    }

    /**
     * Update display status of the specified resource in storage.
     *
     * @return void
     */
    public function switch(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->display = $request->display;
        $category->save();
    }

    public function products($id)
    {
        $products = Product::where([
            ['category_id', $id],
            ['display', 1]
        ])->get([
            'id',
            "name_" . app()->getLocale() . " as name"
        ]);

        if (!$products) {
            $products = [];
        }

        return response()->json($products, 200);
    }

       
   
}
