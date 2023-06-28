@extends('layouts.main')
@section('content')

<?php 
$top = "Welcome to Trisha's Pizza Galore";
$main = "Sales";
?>

<x-page-breadcrumb :top_title="$top" :main_title="$main"></x-page-breadcrumb>

<!-- MAIN Stats-->
<section class="statistic statistic2">
  <div class="container">
      <div class="row">
          <div class="col-md-6 col-lg-3 p-5" style="background-image: url({{ asset('uploads/menus/p3.jpg') }}); background-attachment:fixed; ">
              <div class="statistic__item statistic__item--green p-3" style="background: rgba(230, 6, 230, 0.776); color:white;">
                  <h2 class="number text-white">{{ $users }}</h2>
                  <span class="desc">members online</span>
                  <div class="icon">
                      <i class="zmdi zmdi-account-o"></i>
                  </div>
              </div>
          </div>

          <div class="col-md-6 col-lg-3 p-5" style="background-image: url({{ asset('uploads/menus/p1.jpg') }}); background-attachment:fixed; ">
            <div class="statistic__item statistic__item--green p-3" style="background: rgba(245, 133, 5, 0.834); color:white;">
                <h2 class="number text-white">{{ $total_items_sold }}</h2>
                <span class="desc">items sold</span>
                <div class="icon">
                    <i class="zmdi zmdi-account-o"></i>
                </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 p-5" style="background-image: url({{ asset('uploads/menus/p4.jpg') }}); background-attachment:fixed; ">
            <div class="statistic__item statistic__item--green p-3" style="background: rgba(109, 5, 245, 0.801); color:white;">
                <h2 class="number text-white">P {{ $total_earnings_this_week }}</h2>
                <span class="desc">this week</span>
                <div class="icon">
                    <i class="zmdi zmdi-account-o"></i>
                </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 p-5" style="background-image: url({{ asset('uploads/menus/p5.jpg') }}); background-attachment:fixed; ">
            <div class="statistic__item statistic__item--green p-3" style="background: rgba(5, 121, 245, 0.801); color:white;">
                <h2 class="number text-white">P {{ $total_earnings }}</h2>
                <span class="desc">overall</span>
                <div class="icon">
                    <i class="zmdi zmdi-account-o"></i>
                </div>
            </div>
          </div>

          
          
      </div>
  </div>
</section>
<!-- END MAIN Stats-->

<!-- Best Seller  CHART-->
<div class="cart-section mt-5 mb-1">
  <div class="container">
    <h3>Best Sellers</h3>
    <div class="row">
      
      <div class="col-lg-12">
        <div class="order-details-wrap">
          <table class="order-details w-100">
            <thead>
              <tr >
                <th>Name</th>
                <th style="text-align:center">Total Items Sold</th>
                <th style="text-align:end;">Total Sales</th>
              </tr>
            </thead>
            <tr class="tr-shadow">
              @if(empty($best_sellers))
                <tr>
                    <td colspan="2">No records found</td>
                </tr>
              @else
                @foreach ($best_sellers as $menu)
                  <tr>
                      <td>{{ $menu->name }}</td>
                      <td style="text-align:center">{{ $menu->total_items_sold }}</td>
                      <td style="text-align:end;"><span class="text-success" style="font-weight: bold;">P</span> {{ $menu->total_sales }}</td>
                  </tr>

                @endforeach
                  
              @endif
            </tr>

          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END Best Seller  CHART-->

<!-- Highest Sales TABLE-->
<div class="cart-section mt-5 mb-5">
  <div class="container">
    <h3>Highest Sales</h3>
    <div class="row">

      <div class="col-lg-12">
        <div class="order-details-wrap">
          <table class="order-details w-100">
            <thead>
              <tr >
                <th>Name</th>
                <th>Total payment</th>
              </tr>
            </thead>
              @foreach($highest_sales as $sales)
                <tr class="tr-shadow">
                  @foreach($users_all as $us)
                      <?php 
                          if($sales->user_id == $us->id){
                              $user_name = $us->name;
                          }
                          
                      ?>
                  @endforeach
                    <td>{{ $user_name }}</td>
                    
                    <td><span class="text-success" style="font-weight: bold">P</span> {{ $sales->total_payment }}</td>
                    
                </tr>
              @endforeach

          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END Highest Sales TABLE-->


<!-- Sales -->
<div class="cart-section mt-5 mb-5">
  <div class="container">
    <h3>All Sales</h3>
    <div class="row">
      <div class="col-sm-12">
        <form action="/admin/sales/sales_report" method="post" class="row mb-3">
          @csrf
          <div class="col-sm-3">
            <select name="sales_date" class="form-control " id="" class="w-25" style="margin-right: 10px;">
              <option value="" selected>Select sales filter</option>
              <option value="today">Today</option>
              <option value="this_week">This Week</option>
              <option value="this_month">This Month</option>
              <option value="all">All</option>
              
            </select>
          </div>
          

          <div class="col-sm-1">
            <button class="btn btn-dark" type="submit" style="margin-right: 10px;">Filter</button>
          </div>

          
          <div class="col-sm-3">
            <p class="form-control " style="width:25vw">Total Sales: <span class="text-success" style="font-weight: bold">P</span> {{ $salesTotal }}</p>
          </div>

          
        </form>
        

      </div>
      
    </div>
    <div class="row">

      <div class="col-lg-12">
        <div class="order-details-wrap">
          <table class="order-details w-100">
            <thead>
              <tr >
                <th>Name</th>
                <th>Total payment</th>
                <th>Date</th>
              </tr>
            </thead>
              @foreach($all_sales as $sale)
                <tr class="tr-shadow">
                  @foreach($users_all as $us)
                      <?php 
                          if($sale->user_id == $us->id){
                              $user_name = $us->name;
                          }
                        
                      ?>
                  @endforeach
                    <td>{{ $user_name }}</td>
                    
                    <td><span class="text-success" style="font-weight: bold">P</span> {{ $sale->total_payment }}</td>

                    @php 
                        $d = strtotime($sale->created_at);
                    @endphp
                    <td>{{ date('Y-M-D h:i:a',$d) }}</td>
                </tr>
              @endforeach

          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!--end of Sales -->

@endsection