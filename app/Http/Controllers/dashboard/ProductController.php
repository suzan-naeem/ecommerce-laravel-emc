<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::where('id', '>', 0);
        if(isset($_GET['price_from']) && !empty($_GET['price_from'])) {
            $products = $products->where('price', '>=', $_GET['price_from']);
        }
        if(isset($_GET['price_to']) && !empty($_GET['price_to'])) {
            $products = $products->where('price', '<=', $_GET['price_to']);
        }
        if(isset($_GET['quantity_from']) && !empty($_GET['quantity_from'])) {
            $products = $products->where('expire', '>=', $_GET['quantity_from']);
        }
        if(isset($_GET['quantity_to']) && !empty($_GET['quantity_to'])) {
            $products = $products->where('expire', '<=', $_GET['quantity_to']);
        }

        if(isset($_GET['category']) && !empty($_GET['category'])) {
            $products = $products->where('category_id', $_GET['category']);
        }

        if(isset($_GET['name']) && !empty($_GET['name'])) {
            $products = $products->where(function ($query) {
                $query->where('name_ar', 'LIKE', "%{$_GET['name']}%")
                    ->orWhere('name_en', 'LIKE', "%{$_GET['name']}%");
            });
        }
        $products = $products->get();

        return view('dashboard.product.index', ['products' => $products , 'categories' => Category::all()]);

      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.product.create', ['categories'=> Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $next_id = DB::select("SHOW TABLE STATUS LIKE 'products'");
        // $next_id = $next_id[0]->Auto_increment;
        
            $singleProduct = new Product();
            $singleProduct->category_id = $request->get('category');
            $singleProduct->name_ar = $request->get('name_ar');
            $singleProduct->name_en = $request->get('name_en');
            $singleProduct->desc_ar = $request->get('desc_ar');
            $singleProduct->desc_en = $request->get('desc_en');
            $singleProduct->price = $request->get('price');
            $singleProduct->quantity= $request->get('quantity');
            $singleProduct->weight = $request->get('weight');
            $singleProduct->discount= $request->has('discount') ? $request->discount : null;
            $singleProduct->discount_from = $request->get('discount_from') ?? null;
            $singleProduct->discount_to = $request->get('discount_to') ?? null;
            $singleProduct->display = $request->get('display');
            $singleProduct->deliverable  = $request->get('deliverable');
            $singleProduct->save();
            $id = $singleProduct->id;

        $imagesName = Upload::uploadImages($request->images,'products/' . $id);

        
        foreach ($imagesName as $image) {
            $singleImage = new ProductImage();
            $singleImage->product_id = $id;
            $singleImage->image = $image;
            $singleImage->save();
        }
        dd($imagesName);
        
        return redirect()->back()->with('success', __('messages.productAddedSuccessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard.product.show', ['product'=> $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard.product.edit',['product'=> $product ,'categories'=> Category::all()]);
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
        $product                = Product::findOrFail($id);
        $product->category_id   = $request->get('category');
        $product->name_ar       = $request->get('name_ar');
        $product->name_en       = $request->get('name_en');
        $product->desc_ar       = $request->get('desc_ar');
        $product->desc_en       = $request->get('desc_en');
        $product->price         = $request->get('price');
        $product->quantity      = $request->get('quantity');
        $product->weight        = $request->get('weight');
        $product->discount      = $request->get('discount') ?? null;
        $product->discount_from = $request->get('discount_from') ?? null;
        $product->discount_to   = $request->get('discount_to') ?? null;
        $product->display       = $request->get('display');
        $product->deliverable   = $request->get('deliverable');

        if ($request->images) {
            $imagesName = Upload::uploadImages($request->images,'products/' . $product->id);
        }
        $product->save();
        
        if (isset($imagesName) && is_array($imagesName)) {
            foreach ($imagesName as $image) {
                $singleImage = new ProductImage();
                $singleImage->product_id = $product->id;
                $singleImage->image = $image;
                $singleImage->save();
            }
        }
        return redirect()->back()->with('success', __('messages.productUpdatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        foreach ($product->images as $image) {
            $image->delete();
        }
        Upload::deleteDirectory('products/' . $product->id);
        $product->delete();
        return redirect()->back()->with('success', __('messages.productDeletedSuccessfully'));
    }

    /**
     * Update display status of the specified resource in storage.
     *
     * @return void
     */
   

    public function switch(Request $request, $id)
    {
        $category = Product::findOrFail($id);
        $category->display = $request->display;
        $category->save();
    }

    /**
     * Remove the specified image from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroyImage($id)
    {
        $image = ProductImage::findOrFail($id);
        $product = $image->product;
        if (count($product->images) > 1) {
            Upload::deleteImage($image->image, 'products/' . $product->id);
            $image->delete();
            return redirect()->back()->with('success', __('messages.imageDeletedSuccessfully'));
        } else {
            return redirect()->back()->with('danger', __('messages.cantDeleteLastImage'));
        }

    }

}
