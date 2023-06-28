@extends('layouts.main')
@section('content')
<?php 
$top = "Welcome to Trisha's Pizza Galore";
$main = "Cart";
?>

<x-page-breadcrumb :top_title="$top" :main_title="$main"></x-page-breadcrumb>



<div class="cart-section mt-5 mb-150">
  <div class="container">
    @if($errors->any())
      <div class="row"> 
        @foreach ($errors->all() as $error)
          <div class="col-md-12 ">
            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show m-5">
                <span class="badge badge-pill badge-danger">Error</span>
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
          </div>
        @endforeach
      </div>
    @endif

    @if(session()->has('success'))
    <div class="row">
      <div class="col-md-12">
          <div class="sufee-alert alert with-close alert-primary alert-dismissible fade show  m-5">
              <span class="badge badge-pill badge-primary">Success</span>
              {{ session('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
      </div>
    </div>
    @endif


    <div class="row">
      <div class="col-lg-8 col-md-12">
        <div class="cart-table-wrap">
          <table class="cart-table">
            <thead class="cart-table-head">
              <tr class="table-head-row">
                <th class="product-remove"></th>
                <th class="product-image">Product Image</th>
                <th class="product-name">Name</th>
                <th class="product-price">Price</th>
                <th class="product-quantity">Quantity</th>
                <th class="product-total">Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @php
                $total = 0;
              @endphp
              @empty(!($cart_items))

                @foreach ($cart_items as $item)
                  @php 
                    
                    $menuId = $item->menu_id;
                    $menu = DB::table('menus')->find($menuId);
                  @endphp
                  <tr class="table-body-row">
                    <td class="product-remove">
                      <form action="/admin/cart/delete" method="post">
                        @csrf
                        <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                        <button type="submit" style="border:none"><i class="far fa-window-close"></i></button>
                      </form>
                    </td>

                    <td class="product-image"><img src="{{ (!empty($menu->photo)) ? url('uploads/'.$menu->photo) : url('uploads/no_image.jpg') }}" alt="menu-photo"></td>

                    <td class="product-name">{{ $menu->name }}</td>

                    <td class="product-price">P {{ $menu->price }}</td>

                    <form action="/admin/cart/update" method="post">
                      <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                      <td class="product-quantity"><input  name="quantity" value="{{ !empty($item->quantity) ? $item->quantity : 0 }}" type="number" placeholder="0"></td>

                      <td class="product-total">P {{ ($menu->price * $item->quantity) }}</td>
                      @php 
                        $total += $menu->price * $item->quantity;
                      @endphp
                      <td>
                        @csrf 
                        <button type="submit" class="boxed-btn" style="border:none;">Update</button>
                      </td>

                    </form>
                  </tr>
                @endforeach
              @else
                <tr class="table-body-row">
                  <td class="product-name" colspan="5">No Products Found</td>
              @endempty
              
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="total-section">
          <table class="total-table">
            <thead class="total-table-head">
              <tr class="table-total-row">
                <th>Total</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              <tr class="total-data">
                <td><strong>Subtotal: </strong></td>
                <td>P {{ $total }}</td>
              </tr>
              <tr class="total-data">
                <td><strong>Shipping: </strong></td>
                <td>P {{ ($total > 75) ? '75': 'Free' }}</td>
              </tr>
              <tr class="total-data">
                <td><strong>Total: </strong></td>
                <td>P {{ ($total > 75) ? ($total += 75) : $total }}</td>
              </tr>
              
            </tbody>
          </table>
          <div class="cart-buttons">
            
            <a href="/admin/cart/checkout/{{ auth()->user()->id }}" class="boxed-btn black">Check Out</a>
          </div>
        </div>

       
      </div>
    </div>
  </div>
</div>





@endsection