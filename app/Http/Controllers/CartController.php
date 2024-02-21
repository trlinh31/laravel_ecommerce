<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.pages.view_cart.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request, $id)
    {
        $product = Product::with('product_images')
            ->where('id', '=', $id)->first();
        if (!empty($request->size) && !empty($request->color)) {
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $request->qty,
                'price' => $product->price - ($product->price * $product->discount / 100),
                'weight' => 0,
                'options' => [
                    'size' => $request->size,
                    'color' => $request->color,
                    'image' => $product->product_images[0]->path
                ]
            ]);
            Alert::success('Success', 'Add to cart successfuly');
        } else {
            Alert::warning('Warning', 'Please choose size and color');
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rowId)
    {
        $qty = $request->qty;
        $qty > 0 ? Cart::update($rowId, $qty) : Cart::remove($rowId);
        return redirect()->back();
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Cart::destroy();
        return redirect()->back();
    }
}
