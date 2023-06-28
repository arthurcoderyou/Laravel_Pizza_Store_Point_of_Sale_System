@extends('layouts.main')
@section('content')

<?php 
$top = "Welcome to Trisha's Pizza Galore";
$main = "Completed Orders";
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
                <th>Customer Name</th>
                <th>Total Payment</th>
                <th>Order Status</th>
              </tr>
            </thead>
            @empty(!($completed_orders))
              @foreach ($completed_orders as $order)
                  <tr class="tr-shadow">
                    @foreach($users as $user)
                      <?php 
                          if($user->id == $order->user_id){
                              $user_name = $user->name;
                          }
                      ?>
                    @endforeach
                    <td>{{ $user_name }}</td>
                    <td><span class="text-success" style="font-weight: bold">P</span> {{ $order->total_payment }}</td>
                
                    <td style="font-size: 1rem;">                
                      <div class="badge badge-success">{{ $order->status }}</div>
                    </td>
                    <td class="w-25"><a href="/admin/order/order_details/{{ $order->id }}" class="btn btn-info">Order Menu Details</a></td>
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