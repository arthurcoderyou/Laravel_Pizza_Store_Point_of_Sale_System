@extends('layouts.main')
@section('content')

<?php 
$top = "Welcome to Trisha's Pizza Galore";
$main = "Order Menu Details";
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

      <div class="col-lg-12">
        <div class="order-details-wrap">
          <table class="order-details w-100">
            <thead>
              <tr >
                <th>Menu Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
              </tr>
            </thead>
            @empty(!($order_details))
              @foreach ($order_details as $order)
                <tr class="tr-shadow">
                  <td>{{ $order->menu_name }}</td>
                  <td>{{ $order->menu_price }}</td>
                  <td>{{ $order->menu_quantity }}</td>
                  <td><span class="text-success" style="font-weight: bold">P</span> {{ $order->menu_total_payment }}</td>
                </tr>
              @endforeach
              <tr>
                <td colspan="3">Total: </td>
                <td><span class="text-success" style="font-weight: bold">P</span> {{ $order_main->total_payment }}</td>
              </tr>
            @else
                <tr class="tr-shadow">
                    <td class="text-center" colspan="3">
                        No Menus Found
                    </td>
                    
                </tr>
            @endempty

          </table>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection