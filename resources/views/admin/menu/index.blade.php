@extends('layouts.main')
@section('content')
<?php 
$top = "Welcome to Trisha's Pizza Galore";
$main = "Shop Pizza's";
?>

<x-page-breadcrumb :top_title="$top" :main_title="$main"></x-page-breadcrumb>


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


<div class="row product-lists" style="position: relative; height: 1667.06px;">
  

  @empty(!($menus))
    @foreach ($menus as $menu)

      <div class="col-lg-4 col-md-6 text-center" style="">
        <div class="single-product-item">
          <div class="product-image">
            <a href="#"><img src="{{ (!empty($menu->photo)) ? url('uploads/'.$menu->photo) : url('uploads/no_image.jpg') }}" alt="menu-photo"></a>
          </div>
          <h3>{{ $menu->name }}</h3>
          <p class="product-price"><span>{{ ($menu->available) ? 'Available' : 'Unavailable' }}</span> <span>{{ $menu->stocks }} in stocks</span> P {{ $menu->price }} </p>

          @auth
          {{-- update --}}
            @if(auth()->user()->role == "admin")
              <a href="/admin/menu/update/{{ $menu->id }}" style="background: rgb(83, 176, 212); margin-bottom: 5px;" class="cart-btn"><i class="fas fa-edit"></i> Update</a>

              {{-- delete 
              <form action="/admin/menu/delete" method="post">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                <button class="boxed-btn" style="background: red; border:none; margin:5px;" type="submit">Delete</button>
              </form>
              --}}
            @endif
          @endauth

          {{-- add to cart --}}
          <form action="/admin/menu/add_to_cart" method="post">
            @csrf
            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <button type="submit"  class="boxed-btn" style="border:none;"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
          </form>
          
        </div>
      </div>

    @endforeach
 

    @else
    <div class="col-lg-12 col-md-12 text-center" style="position: absolute; left: 0px; top: 0px;">
      <div class="single-product-item">
        
        <h3>No Product Found</h3>
      </div>
    </div>
  @endempty
  
</div>

@endsection