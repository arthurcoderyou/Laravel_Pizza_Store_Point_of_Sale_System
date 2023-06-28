<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderMenu;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function pending(){
        $users = User::all();
        $pending_orders = Order::where('status','pending')->latest()->get();
        return view('admin.transaction.pending_orders',compact('users','pending_orders'));
    }

    public function completed(){
        $users = User::all();
        $completed_orders = Order::where('status','completed')->latest()->get();
        return view('admin.transaction.completed_orders',compact('users','completed_orders'));
    }

    public function denied(){
        $users = User::all();
        $denied_orders = Order::where('status','denied')->latest()->get();
        return view('admin.transaction.denied_orders',compact('users','denied_orders'));
    }


    public function update(Request $request){
        $validateData = $request->validate([
            'order_id' => 'required',
            'order_status' => 'required',
            'order_shipping_status' => 'required'
        ]);

        if($validateData){
            $order = Order::find($validateData['order_id']);
            $order->status = $validateData['order_status'];
            $order->shipping_status = $validateData['order_shipping_status'];


            //if order status == 'completed'
            if($order->status == 'completed'){
                $order_menus = OrderMenu::where('order_id',$order->id)->get();
                $menus = Menu::all();
                foreach($order_menus as $om){
                    foreach($menus as $menu){
                        if($om->menu_id == $menu->id){
                            //decrease the stock by the quantity bought
                            $menu->stocks -= $om->menu_quantity;
                            //add total sales to the menu
                            $menu->total_sales += $om->menu_total_payment;
                            //add total items sold
                            $menu->total_items_sold += $om->menu_quantity;
                        }
                        $menu->save();
                    }

                }

            }


        }

        $order->save();
        return redirect()->back()->with('success','Order Status Updated Successfully');
    }
}
