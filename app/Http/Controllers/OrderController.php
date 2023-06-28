<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderMenu;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index(){
        $orders = Order::where('user_id',auth()->user()->id)->latest()->get();
        return view('order.index',compact('orders'));
    }

    public function order_menu_details($order_id){
        $order_details = OrderMenu::where('order_id',$order_id)->get();

        // total
        $order_main = Order::find($order_id);

        return view('order.order_menu_details',compact('order_details','order_main'));
        
    }


    public function delete(Request $request){
        $order = Order::find($request->order_id);
        $order->delete();
        return redirect()->back()->with('success','Order Deleted/Cancelled Successfully');
    }

}


