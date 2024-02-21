<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $product_cates = ProductCategory::all();
        return view('admin.pages.product_cate.index', compact('product_cates'));
    }

    public function create()
    {
        return view('admin.pages.product_cate.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:200',
        ]);
        $product_cate = new ProductCategory();
        $product_cate->name = $validatedData["name"];
        $product_cate->slug = Str::slug($validatedData["name"]);
        $product_cate->save();
        toast('Create new category successfull', 'success');
        return redirect()->route('admin.product_cates.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product_cate = ProductCategory::find($id);
        return view('admin.pages.product_cate.edit', compact('product_cate'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:200',
        ]);
        $product_cate = ProductCategory::find($id);
        $product_cate->name = $validatedData['name'];
        $product_cate->save();
        toast('Update category successfull', 'success');
        return redirect()->route('admin.product_cates.index');
    }

    public function destroy($id)
    {
        ProductCategory::destroy($id);
        toast('Delete category successfull', 'success');
        return redirect()->route('admin.product_cates.index');
    }

    public function getAll()
    {
        $product_cates = ProductCategory::all();
        return response()->json([
            'data' => $product_cates
        ]);
    }
}
