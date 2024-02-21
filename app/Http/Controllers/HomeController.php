<?php

namespace App\Http\Controllers;

use App\Mail\SubscribeMail;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $product_cates = ProductCategory::all();
        $products = Product::with(['product_images', 'product_category'])->get();
        return view('client.pages.homepage.index', compact('products', 'product_cates'));
    }

    public function about()
    {
        return view('client.pages.about.index');
    }

    public function subscribe(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);
        $email = $validatedData['email'];
        Mail::to($email)->send(new SubscribeMail());
        Alert::success('Success', 'Please check your gmail');
        return redirect('/');
    }
}
