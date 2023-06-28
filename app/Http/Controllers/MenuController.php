<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    
    //show all menus
    public function index(){
        $menus = Menu::where('id','>','0')->latest()->get();
        return view('admin.menu.index',compact('menus'));
    }

    //search menu
    public function search(Request $request){
        //dd($request->all());

        $validateData = $request->validate([
            'search_value' => 'required'
        ]);

        if($validateData){
            $menus = Menu::where('name','like','%'.$validateData['search_value'].'%')->get();
            return view('admin.menu.index',compact('menus'));
        }

    }


    //create menu
    public function create(){
        return view('admin.menu.create');
    }

    
    //create menu store
    public function create_store(Request $request){
        //dd($request->all());

        $validateData = $request->validate([
            'menu_name' => 'required',
            'menu_price' => 'required',
            'menu_stocks' => 'required',
            'menu_available' => 'required',
        ]);

        if($validateData){
            if($validateData['menu_available'] == '1'){
                $av = true;
            }else{
                $av = false;
            }

            $menu = Menu::create([
                'name' => $validateData['menu_name'],
                'price' => $validateData['menu_price'],
                'stocks' => $validateData['menu_stocks'],
                'available' => $av,
            ]);
        }

        if($request->file('menu_photo')){
            $file = $request->file('menu_photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/menus'),$filename);

            $menu['photo'] = "menus/".$filename;
        }

        $menu->save();
        return redirect()->back()->with('success','Menu Added Successfully');
        //return redirect('/admin/menu/index')->with('success','Menu Added Successfully');
    }


    //update menu
    public function update($menu_id){
        $menu = Menu::find($menu_id);
        return view('admin.menu.update',compact('menu'));
    }

    //update menu store
    public function update_store(Request $request){
        $validateData = $request->validate([
            'menu_id' => 'required',
            'menu_name' => 'required',
            'menu_price' => 'required',
            'menu_stocks' => 'required',
            'menu_available' => 'required'
        ]);


        if($validateData){
            $menu = Menu::find($validateData['menu_id']);

            $menu->name = $validateData['menu_name'];
            $menu->price = $validateData['menu_price'];
            $menu->stocks = $validateData['menu_stocks'];
            $menu->available = $validateData['menu_available'];
            
        }

        if($request->file('menu_photo')){
            $file = $request->file('menu_photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/menus'),$filename);

            $menu['photo'] = "menus/".$filename;
        }

        $menu->save();
        return redirect()->back()->with('success','Menu Updated Successfully');
        //return redirect('/admin/menu/index')->with('success','Menu Updated Successfully');
    }

    //delete menu
    public function delete(Request $request){
        $validateData = $request->validate([
            'menu_id' => 'required'
        ]);

        $menu = Menu::find($validateData['menu_id']);
        $menu->delete();
        return redirect('/admin/menu/index')->with('success','Menu Deleted Successfully');
    }


    //menu add to cart
    public function add_to_cart(Request $request){
        $validateData = $request->validate([
            'menu_id' => 'required',
            'user_id' => 'required'
        ]);

        if($validateData){

            $carts = Cart::all();

            $found = false;
            //check if the menu id and user id is already on the cart
            foreach ($carts as $cart) {
                if($cart->user_id == $validateData['user_id'] && $cart->menu_id == $validateData['menu_id']){
                    $found = true;
                }
            }

            if($found){
                return redirect('/admin/menu/index')->withErrors('Menu already exist on the Cart');
            }else{
                Cart::create([
                    'menu_id' => $validateData['menu_id'],
                    'user_id' => $validateData['user_id'],
                    'quantity' => 1,
                ]);
            }
            
        }

        return redirect('/admin/menu/index')->with('success','Menu Added to Cart');
    }
    /**/
}
