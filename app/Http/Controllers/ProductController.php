<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $categories = ProductCategory::all();
    $query = Product::with(['product_images']);
    if (!empty($request->c)) {
      $c = $request->c;
      if ($c != 'all') {
        $query->where('product_category_id', '=', $c);
      }
    }
    if (!empty($request->p)) {
      $p = $request->p;
      switch ($p) {
        case '00-50':
          $query->whereBetween('price', [0, 50]);
          break;
        case '50-100':
          $query->whereBetween('price', [50, 100]);
          break;
        case '100-150':
          $query->whereBetween('price', [100, 150]);
          break;
        case '200':
          $query->where('price', '>=', 200);
          break;
      }
    }
    $products = $query->get();
    return view('client.pages.product.index', compact('products', 'categories'));
  }

  public function show(Request $request, $id)
  {
    $product = Product::with([
      'product_category',
    ])->where('id', '=', $id)
      ->first();
    $product_comments = ProductComment::with([
      'user',
      'product'
    ])->where('product_id', '=', $id)->get();
    if (!$product) {
      abort(404);
    }
    return view('client.pages.product_detail.index', compact('product', 'product_comments'));
  }

  public function postComment(Request $request, $id)
  {
    $validatedData = $request->validate([
      'rating' => 'required',
      'review' =>  'required|string'
    ]);
    $comment = new ProductComment();
    $comment->user_id = Auth::user()->id;
    $comment->product_id = $id;
    $comment->message = $validatedData['review'];
    $comment->rating = $validatedData['rating'];
    $comment->save();
    Alert::success('Success', 'Post comment successful');
    return redirect()->back();
  }

  public function search(Request $request)
  {
    $products = Product::with(['product_images'])
      ->where('name', 'like', '%' . $request->keyword . '%')
      ->get();
    return view('client.pages.product.search', compact('products'));
  }
}
