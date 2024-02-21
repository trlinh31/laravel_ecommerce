<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Utilities\VNPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('client.pages.checkout.index');
    }

    public function checkout(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'address' => 'required|string',
            'payment_type' => 'required'
        ]);
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }
        $user = Auth::user();

        $order = new Order();
        $order->user_id = $user->id;
        $order->full_name = $validatedData['name'];
        $order->phone = $validatedData['phone'];
        $order->country = $request['country'];
        $order->city = $request['city'];
        $order->address = $validatedData['address'];
        $order->payment_type = $validatedData['payment_type'];
        if ($order->save()) {
            $carts = Cart::content();
            foreach ($carts as $cart) {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $cart->id;
                $orderDetail->quantity = $cart->qty;
                $orderDetail->price = $cart->price * $cart->qty;
                $orderDetail->size = $cart->options->size;
                $orderDetail->color = $cart->options->color;
                $orderDetail->save();
            }
        }
        if ($validatedData['payment_type'] == 'cod') {
            Cart::destroy();
            $order = Order::with(['order_details.product', 'user'])->where('id', '=', $order->id)->first();
            Mail::to(Auth::user()->email)->send(new OrderShipped($order, 'Your Order Has Shipped!'));
            Alert::success('Success', 'Order is being shipped');
            return redirect('/');
        }
        if ($validatedData['payment_type'] == 'card') {
            $data_url = VNPay::vnpay_create_payment([
                'vnp_TxnRef' => $order->id,
                'vnp_OrderInfo' => 'Thanh toán đơn hàng',
                'vnp_Amount' => Cart::priceTotal(0, '', '') * 24530,
            ]);
            return redirect()->to($data_url);
        }
    }

    public function vnPayCheck(Request $request)
    {
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        $vnp_TxnRef = $request->get('vnp_TxnRef');
        if ($vnp_ResponseCode != null) {
            if ($vnp_ResponseCode == 00) {
                $order = Order::find($vnp_TxnRef);
                $order->is_paid = true;
                $order->save();
                Mail::to(Auth::user()->email)->send(new OrderShipped($order, 'The order has been paid!'));
                Cart::destroy();
                Alert::success('Success', 'Order payment successful');
                return redirect('/');
            } else {
                Alert::error('Error', 'Order payment failed');
                return redirect('/');
            }
        }
    }
}
