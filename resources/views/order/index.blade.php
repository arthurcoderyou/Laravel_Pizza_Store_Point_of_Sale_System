@extends('layouts.main')
@section('content')

<?php 
$top = "Welcome to Trisha's Pizza Galore";
$main = "Orders";
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
          <p><strong>Note: Orders can only be cancelled when shipping status is "To be Shipped"</strong></p>
          <table class="order-details w-100">

            <thead>

              <tr >
                <th>Total Payment</th>
                <th>Shipping Status</th>
                <th colspan="">Order Status</th>
                <th>Details</th>
                <th>Delete/Cancel Order</th>
              </tr>
            </thead>
            @empty(!($orders))
              @foreach ($orders as $order)
                  <tr class="tr-shadow">
                    <td><span class="text-success" style="font-weight: bold">P</span> {{ $order->total_payment }}</td>
                    <td> 
                      @if($order->shipping_status == "to_be_shipped")
                        <span class="text-secondary ">To be Shipped</span>
                        
                      @elseif($order->shipping_status == "to_recieve")
                        
                        <span class="text-primary ">To be Received</span>
                      @elseif($order->shipping_status == "completed")
                        
                        <span class="text-completed ">Completed</span>
                      @endif
                    </td>
                    <td style="font-size: 1rem;">
                        @if($order->status == 'pending' )
                            <div class="badge badge-warning">{{ $order->status  }}</div>
                        @elseif($order->status == 'completed' )
                            <div class="badge badge-success">{{ $order->status  }}</div>
                        @elseif($order->status == 'denied' )
                            <div class="badge badge-danger">{{ $order->status  }}</div>
                        @endif

                    </td>
                    <td class="w-25"><a href="/admin/order/order_details/{{ $order->id }}" class="btn btn-info">Order Menu Details</a></td>
                    <td class="w-25">
                      <form action="/admin/order/delete" method="post">
                        @csrf 
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <button class="btn btn-danger" {{ ($order->shipping_status == 'to_be_shipped') ? '' : 'disabled'}}>Delete/Cancel</button>
                      </form>
                    </td>
                  </tr>
              @endforeach
              
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