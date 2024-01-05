<?php

namespace App\Http\Controllers;

use Stripe;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\Cart_product;
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
        $user = Auth::user();
        if ($user && $user->cart) {

            return $cart = auth()->user()->cart->count();
        }
        return 0;
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
        // $user = Auth::user();s
        $users = User::all();
        foreach ($users as $user) {
            foreach ($user->products as $product) {
                $productDetail = $product->find($req->id);
                // dd($productDetail);
                $comment_product = $productDetail->comments;
            }
            // $productDetail = $user->products->find($req->id);
        }
        // dd($productDetail);
        $totalCart = $this->cartItem();
        return view('home.productDetail', compact('productDetail', 'totalCart',  'comment_product'));
    }

    public function addToCart($id)
    {
        $user = Auth::user();
        $product = Product::find($id);
        $cart = new Cart;
        $user =  $user->cart()->save($cart);
        $user->products()->attach($product->id);
        $cartProduct = $user->cart;
        return back();
    }

    public function cartShow(Request $req)
    {
        // $user = User::find(Auth::id());
        $user = Auth::user();
        // dd($user);
        $cart = $user->cart;
        $allProducts = [];
        foreach ($cart as $cart) {
            $products = $cart->products;
            $allProducts = array_merge($allProducts, $products->toArray());
            // dd($allProducts);
        }
        // dd($cart);
        $totalCart = $this->cartItem();
        // dd($allProducts);
        return view('home.cartItem', compact('allProducts', 'totalCart'));
    }

    public function deleteCart($id)
    {
        $user = User::find(Auth::id());
        foreach ($user->cart as $cart) {
            foreach ($cart->products as $product) {
                $cart->products()->detach($id);
                if ($cart->products()->count() === 0) {
                    $cart->delete();
                }
            }
        }
        return back()->with('message', 'The Is removed successfully');
        die;
        // $product = Product::find($req->id);
        // $cart = Cart::find($req->id);
        $user->cart->products()->detach($id);
        // $user->cart()->delete();
        return back()->with('message', 'The Is removed successfully');
    }


    public function order($id)
    {

        $user_id = User::find(Auth::id());
        $order = new Order;

        $user = $user_id->orders()->save($order);
        foreach ($user_id->cart as $cart) {
            // dump($cart);
            foreach ($cart->products as $product) {
                $order->products()->attach($id);
                $order->payment_status = "Cash On delievery";
                $order->delievery = "processing";
                $cart->products()->detach($id);
                if ($cart->products()->count() === 0) {
                    $cart->delete();
                }
            }
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
    public function stripePost(Request $request, $total)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $total * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);


        Session::flash('success', 'Payment successful!');
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
        // $product = $user->products()->find($req->id);

        $comments = new Comment;
        $comments->product_id = $product->id;
        $comments->comment = $req->comment;
        $comments = $user->comments()->save($comments);
        // dd($comments);
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
        // dd($reply);
        $reply->save();
        return back();
    }
}
