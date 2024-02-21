<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.pages.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.pages.brand.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:200|unique:brands',
        ]);
        $brand = new Brand();
        $brand->name = $validatedData['name'];
        $brand->slug = Str::slug($validatedData['name']);
        $brand->save();
        toast('Create new brand successfull', 'success');
        return redirect()->route('admin.brands.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.pages.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:200',
        ]);
        $brand = Brand::find($id);
        $brand->name = $validatedData['name'];
        $brand->save();
        toast('Update brand successfull', 'success');
        return redirect()->route('admin.brands.index');
    }

    public function destroy($id)
    {
        Brand::destroy($id);
        toast('Delete brand successfull', 'success');
        return redirect()->route('admin.brands.index');
    }
}
