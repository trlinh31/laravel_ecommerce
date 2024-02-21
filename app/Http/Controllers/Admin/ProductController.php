<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductDetail;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private function remove_commas($string)
    {
        $result = str_replace(',', '', $string);
        if (is_numeric($result)) {
            return $result;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['brand', 'product_category', 'product_images'])->paginate(3);
        return view('admin.pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $product_cates = ProductCategory::all();
        return view('admin.pages.product.create', compact('brands', 'product_cates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'brand' => 'required',
            'category' => 'required',
            'name' => 'required|string',
            'images.*' => 'required|image|max:2048',
            'price' => 'required',
            'qty' => 'required'
        ]);
        if (!$request->hasFile('images')) {
            return redirect()->back()->with('msg', 'Images is required !!!');
        }
        $price = $this->remove_commas($request->price);

        $product = new Product();
        $product->brand_id = $validatedData['brand'];
        $product->product_category_id = $validatedData['category'];
        $product->name = $validatedData['name'];
        $product->slug = Str::slug($validatedData['name']);
        $product->description = $request->input('description');
        $product->price = $price;
        $product->qty = $validatedData['qty'];
        $product->discount = $request->discount ?? 0;
        $product->featured = $request->featured ?? 0;
        $product->save();
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $image_name = $product->slug . '-' . $index . '-' . time() . '.' . $image->extension();
                $image->move(public_path('images'), $image_name);
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $image_name
                ]);
            }
        }
        toast('Create new product successfull', 'success');
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = Brand::all();
        $product_cates = ProductCategory::all();
        $product = Product::with(['product_images'])->where('id', '=', $id)->first();
        return view('admin.pages.product.edit', compact('brands', 'product_cates', 'product'));
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
        $validatedData = $request->validate([
            'brand' => 'required',
            'category' => 'required',
            'name' => 'required|string',
            'images.*' => 'required|image|max:2048',
            'price' => 'required',
            'qty' => 'required'
        ]);
        $price = $this->remove_commas($request->price);
        $product = Product::find($id);
        $product->brand_id = $validatedData['brand'];
        $product->product_category_id = $validatedData['category'];
        $product->name = $validatedData['name'];
        $product->slug = Str::slug($validatedData['name']);
        $product->description = $request->input('description');
        $product->price = $price;
        $product->qty = $validatedData['qty'];
        $product->discount = $request->discount ?? 0;
        $product->featured = $request->featured ?? 0;
        $product->save();
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $image_name = $product->slug . '-' . $index . '-' . time() . '.' . $image->extension();
                $image->move(public_path('images'), $image_name);
                $product_image = ProductImage::find($product->id);
                $product_image->path = $image_name;
                $product_image->save();
            }
        }
        toast('Update product successfull', 'success');
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        toast('Delete product successfull', 'success');
        return redirect()->route('admin.products.index');
    }
}
