<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\TestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\PDF;
// use Illuminate\Notifications\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;


class AdminController extends Controller
{
    public function admindata(Request $req)
    {
        $user = Auth::user();
        $data = Product::all()->count();
        // dd($orders);
        $ordersall = auth()->user()->orders()->count();
        $users = User::where('usertype', '0')->count();
        $orders = $user->orders()->with('products')->get();
        $revenueD = 0;
        $revenue = 0;
        $totalrevenue = 0;
        foreach ($orders as $order) {
            foreach ($order->products as $ord) {
                if ($ord->discount_price == !null) {
                    $revenueD = $ord->discount_price + $revenueD;
                } else {
                    $revenue = $ord->price + $revenue;
                }
                $totalrevenue = $revenueD + $revenue;
            }
        }
        // if ($ordersall > 0) {
        // $deliveredorder = Order::where('delivery', 'Delivered')->count();
        // $order = Order::where('delivery', 'Processing')->count();
        // $cancelorder = Order::where('delivery', 'Order Canceled')->count();
        // $totalorders = Order::all()->count();

        //
        return view('admin.adminHome', compact('data',  'users',  'ordersall', 'totalrevenue'));
        die;
        // }



        // return view('admin.adminHome', compact('users', 'data', 'ordersall'));
    }
    public function showCategory()
    {
        $data = Category::all();
        return view('admin.adminCategory', compact('data'));
    }
    public function AddCategory(Request $req)
    {
        $req->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        $data = new Category;
        $data->category_name = $req->category_name;
        $data->save();

        return redirect()->back()->with('message', 'The Category has been added successfully');
    }

    public function deleteCategory($id)
    {
        $data = Category::find($id);
        $data->delete();
        return back()->with('message', 'The category has been Deleted!');
    }
    public function addproduct()
    {
        $data = Category::all();
        return view('admin.adminAddproduct', compact('data'));
    }
    public function addnewProduct(Request $req)
    {
        $user = Auth::user();
        $data = new Product;
        $req->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'quantity' => 'required',
            'category' => 'required',
            'price' => 'required',
        ]);
        $data->title = $req->title;
        $data->description = $req->description;
        $data->category_id = $req->category;
        $data->quantity = $req->quantity;
        $data->price = $req->price;
        $data->discount_price = $req->discount_price;
        $data->image = $req->file('image')->store('images', 'public');
        $user = $user->products()->save($data);
        // dd($user);
        return redirect('dashboard/showProduct')->with('message', 'Product Uploaded Successfully');
    }
    public function showProduct()
    {
        $product = Product::all();
        return view('admin.adminShowproduct', compact('product'));
    }
    public function productDelete($id)
    {
        $user = Auth::user();
        $product = $user->products()->find($id);
        // dd($product);
        if ($product->carts) {
            $product->carts()->detach();
            $product->orders()->detach();
        }

        $product->delete();
        // $data->delete();
        return back()->with('delete', 'The Product Delete SuccessFully');
    }


    public function showUpdateData(Request $req)
    {
        $data = Product::find($req->id);
        $catData = Category::all();
        return view('admin.adminProductUpdate', compact('data', 'catData'));
    }

    public function updateProduct(Request $req)
    {
        $user = Auth::user();

        $data = $user->products()->find($req->id);
        // dd($data);
        $req->validate([
            'title' => 'required',
            'description' => 'required',
            // 'image' => 'required',
            'quantity' => 'required',
            'category' => 'required',
            'price' => 'required',
        ]);
        $data->title = $req->title;
        $data->description = $req->description;
        $data->category_id = $req->category;
        $data->quantity = $req->quantity;
        $data->price = $req->price;
        $data->discount_price = $req->discount_price;
        if ($req->hasFile('image')) {

            Storage::disk('public')->delete($data->image);


            $data->image = $req->file('image')->store('images', 'public');
        } else {

            $data->image = $data->image;
        }
        $data->save();

        return redirect('dashboard/showProduct')->with('message', 'Product Updated Successfully');
    }
    public function ShowOrders()
    {
        $user = Auth::user();
        $orders = $user->orders;
        $allproducts = [];

        foreach ($orders as $order) {
            if ($order->products) {

                foreach ($order->products as $products) {
                    $name = $user->name;
                    $allproducts[] = $products->toArray();
                }
            }
        }


        return view('admin.adminOrder', compact('allproducts', 'name'));
    }
    public function deliverd($id)
    {
        $order = Order::find($id);
        $order->delivery = "Delivered";
        $order->payment_status = "Paid";
        $order->save();
        return back();
    }
    public function download_pdf($id)
    {
        $order = Order::find($id);
        $pdf = PDF::loadView('admin.pdf', compact('order'));
        return $pdf->download('order_details.pdf');
    }
    public function send_email($id)
    {
        $user = Auth::user();
        $order = $user->orders->find($id);
        // dd($order);
        $email = $user->email;
        return view('admin.adminSendemail', compact('order', 'email'));
    }
    // public function sending_email(Request $req)
    // {
    //     $user = Auth::user();
    //     $order = $user->orders->find($req->id);

    //     $details = [
    //         'greeting' => $req->greeting,
    //         'subject' => $req->subject,
    //         'message' => $req->message,
    //         'url' => $req->url,

    //     ];
    //     Notification::notify(new TestNotification($details));
    //     return back();
    // }
    public function adminsearch(Request $req)
    {
        $searchtext = $req->search;
        $product = Product::where('title', 'LIKE', "%$searchtext%")->get();
        // dd($product);
        return view('admin.adminShowproduct', compact('product'));
    }
}
