<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderMenu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //index cart items
    public function index(){
        $cart_items = Cart::where('user_id',auth()->user()->id)->get();
        return view('cart',compact('cart_items'));
    }

    //to update cart item
    public function update(Request $request){
        //dd($request->all());

        
        $validateData = $request->validate([
            'quantity' => ['required',''],
            'cart_item_id' => ['required']
        ]);

        
        if($validateData){
            $cart = Cart::find($validateData['cart_item_id']);
            $menu = Menu::find($cart->menu_id);

            //the stocks to be bought must not exceed the available stocks on the database
            if($validateData['quantity'] <= $menu->stocks){
                $cart->quantity = $validateData['quantity'];
            }else{
                return redirect()->back()->withErrors(' Cart is not Updated. Quantity must not exceed '.$menu->stocks);
            }

            
        }

        $cart->save();
        return redirect()->back()->with('success','Cart Item Updated Successfully');
    }

    //to delete cart item
    public function delete(Request $request){
        $validateData = $request->validate([
            'cart_item_id' => ['required']
        ]);
        if($validateData){
            $cart = Cart::find($validateData['cart_item_id']);
            
            $cart->delete();
        }

        return redirect()->back()->with('success','Cart Item Deleted Successfully');
    }

    //
    public function checkout($user_id){
        
        //total payment
        $total = 0;
        $carts = Cart::where('user_id',$user_id)->get();

        $count = 0;
        foreach($carts as $cart){
            $count++;
        }
        
        if($count == 0){
            return redirect()->back()->withErrors('Cart is empty. Your cart must have atleast one menu to checkout');
            
        }else{

            //create_new_order
            $order = Order::create([
                'user_id' => $user_id,
            ]);

            //insert all from cart into order_menus
            foreach ($carts as $cart) {
                $menu = Menu::find($cart->menu_id);
                
                //calculate menu total payment
                $menu_total_payment = $menu->price * $cart->quantity;

                //create new order_menu
                OrderMenu::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id, //for the updating of the menu stock in the order payment verification
                    'menu_name' => $menu->name,
                    'menu_price' => $menu->price,
                    'menu_quantity' => $cart->quantity,
                    'menu_total_payment' => $menu_total_payment,
                ]);


                $total += $menu_total_payment;
            }


            if($total > 75){
                $total += 75;
            }

            //update the order total payment after 
            $order['total_payment'] = $total;
            //save the order
            $order->save();


        

            //delete all from the cart
            foreach($carts as $cart){
                $cart->delete();
            }
            

            return view('checkout',compact('order'));

        }
        //return view('checkout');
    }

}
