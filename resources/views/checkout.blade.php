@extends('layouts.main')
@section('content')

<?php 
$top = "Welcome to Trisha's Pizza Galore";
$main = "Checkout";
?>

<x-page-breadcrumb :top_title="$top" :main_title="$main"></x-page-breadcrumb>


<div class="cart-section mt-5 mb-150">
  <div class="container">
    <div class="row">

      <div class="col-lg-6">
        <div class="order-details-wrap">
          <table class="order-details w-100">
            <thead>
              <tr style="text-align: center">
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
              </tr>
            </thead>
            <?php
              $order_menus = DB::table('order_menus')->where('order_id',$order->id)->get();

            ?>
            <tbody class="order-details-body">
              
              @foreach ($order_menus as $menu)
                <tr style="text-align: center">
                  <td>{{ $menu->menu_name }}</td>
                  <td>P {{ $menu->menu_price }}</td>
                  <td>{{ $menu->menu_quantity }}</td>
                  <td>P {{ $menu->menu_total_payment }}</td>
                </tr>
              @endforeach
            </tbody>
            <tbody class="checkout-details">
              <tr style="text-align: center">
                <td colspan="3">Subtotal</td>
                <td>P {{ ($order->total_payment > 75) ? '75' : 'Free' }}</td>
              </tr>
              <tr style="text-align: center">
                <td colspan="3">Subtotal</td>
                <td>P {{ $order->total_payment }}</td>
              </tr>
              
            </tbody>
          </table>
        </div>
      </div>
  
      <div class="content-column col-lg-6">
        <h3><span class="orange-text">Trisha's</span> Pizza Galore</h3>
        <h4>Different Pizza, Different Love</h4>
        <div class="text">Thank you for Choosing Us. We hope you enjoyed and please come again</div>
          <!--Countdown Timer-->
          
        <a href="/generate-pdf/{{ $order->id }}" class="cart-btn mt-3"><i class="fas fa-print"></i>Print Invoice</a>
      </div>
    </div>
    

  </div>
</div>
@endsection