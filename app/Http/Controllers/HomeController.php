<?php

namespace App\Http\Controllers;

use Stripe;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class HomeController extends Controller
{

    public function cartItem()
    {
        return count(Cart::where('user_id', Auth::id())->get());
    }
    public function index(Request $req)
    {
        $product = Product::take(3)->get();
        $totalCart = $this->cartItem();
        return view('index', compact('product', 'totalCart'));
    }
    public function allproduct(Request $req)
    {
        $product = Product::all();
        $totalCart = $this->cartItem();
        return view('home.allproduct', compact('product', 'totalCart'));
    }
    public function productDetail(Request $req)
    {
        $productDetail = Product::find($req->id);
        $product_id = $productDetail->id;

        $allcom = Comment::where('product_id', $product_id)->get();
        $allcom_id = $req->id;
        if ($allcom_id) {
            $reply = Reply::where('comment_id', $allcom_id)->get();
            // dd($reply);
        }

        $totalCart = $this->cartItem();
        return view('home.productDetail', compact('productDetail', 'totalCart', 'allcom', 'reply'));
    }

    public function addToCart($id)
    {

        $user = Auth::user();
        $product = Product::find($id);
        $cart = new Cart;
        $cart->name = $user->name;
        $cart->user_id = $user->id;
        $cart->user_email = $user->email;
        $cart->product_id = $product->id;
        $cart->title = $product->title;
        $cart->image = $product->image;
        $disPrice = $product->discount_price;
        if ($disPrice == !null) {
            $cart->price = $product->price;

            $cart->discount_price = $disPrice;
        } else {
            $cart->price = $product->price;
        }
        $cart->save();
        return back();
    }

    public function cartShow()
    {
        $id = Auth::user()->id;
        $cart = Cart::where('user_id', '=', $id)->get();
        $totalCart = $this->cartItem();

        return view('home.cartItem', compact('cart', 'totalCart'));
    }

    public function deleteCart(Request $req)
    {
        $cart = Cart::find($req->id);
        $cart->delete();
        return back()->with('message', 'The Is removed successfully');
    }


    public function order(Request $req)
    {
        $user = Auth::user();
        $userId = $user->id;
        $cartData = Cart::where('user_id', $userId)->get();
        // $product = Cart::find($req->id);
        // dd($cartData);
        foreach ($cartData as $Data) {
            $order = new Order;
            $order->name = $Data->name;
            $order->user_id = $user->id;
            $order->product_id = $Data->id;
            $order->title = $Data->title;
            $order->image = $Data->image;
            $order->payment_status = 'Cash On Delivery';
            $order->delivery = 'Processing';
            $order->phone = $req->phone;
            $order->email = $Data->user_email;
            $disPrice = $Data->discount_price;
            if ($disPrice == !null) {
                $order->price = $Data->price;
                $order->discount_price = $Data->discount_price;
            } else {
                $order->price = $Data->price;
            }
            $order->save();
            $cart_id = $Data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        return back();
    }
    public function stripe($total)
    {
        // dd($total);
        // $id = Auth::user()->id;
        // $cart = Cart::where('user_id', '=', $id)->get();
        $totalCart = $this->cartItem();
        return view('home.stripe', compact('total', 'totalCart'));
    }
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => 100 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);

        Session::flash('success', 'Payment successful!');
        $user = Auth::user();
        $userId = $user->id;
        $cartData = Cart::where('user_id', $userId)->get();
        // $product = Cart::find($req->id);
        // dd($cartData);
        foreach ($cartData as $Data) {
            $order = new Order;
            $order->name = $Data->name;
            $order->user_id = $user->id;
            $order->product_id = $Data->id;
            $order->title = $Data->title;
            $order->image = $Data->image;
            $order->payment_status = 'Card payment';
            $order->delivery = 'Processing';
            $order->phone = $request->phone;
            $order->phone = $user->email;
            $disPrice = $Data->discount_price;
            if ($disPrice == !null) {
                $order->price = $Data->price;

                $order->discount_price = $Data->discount_price;
            } else {
                $order->price = $Data->price;
            }
            $order->save();
            $cart_id = $Data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        return back();
    }
    public function order_detail()
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->get();
        $totalCart = $this->cartItem();
        return view('home.order', compact('order', 'totalCart'));
    }
    public function cancel_order(Request $req)
    {
        $order = Order::find($req->id);

        if ($order->delivery !== 'Delivered') {
            $order->delivery = 'Order Canceled';
        }
        $order->save();
        return back();
    }
    public function comments(Request $req)
    {
        $user = Auth::user();
        $product = Product::find($req->id);
        $comment = new Comment;
        $comment->name = $user->name;
        $comment->user_id = $user->id;
        // dd($comment);
        $comment->comment = $req->comment;
        $comment->product_id = $product->id;
        // dd($comment);
        $comment->save();
        return back();
    }
    public function reply(Request $req, $commentId)
    {
        $comment = Comment::find($req->id);
        $reply = new Reply;
        $reply->name = Auth::user()->name;
        $reply->replay = $req->reply;
        $reply->comment_id = $commentId;
        $reply->user_id = Auth::user()->id;
        dd($reply);
        $reply->save();
        return back();
    }
}
