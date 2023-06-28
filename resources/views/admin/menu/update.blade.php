@extends('layouts.main')
@section('content')

<?php 
    $top = "Welcome to Trisha's Pizza Galore";
    $main = "Update Shop Pizza";
?>

<x-page-breadcrumb :top_title="$top" :main_title="$main"></x-page-breadcrumb>



<div class="checkout-section mt-5 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>Update Pizza Menu</h5>
                    </div>
                    <div class="card-body">
                        <div class="billing-address-form">
                            @if($errors->any())
                              @foreach ($errors->all() as $error)
                                <div class="col-md-12">
                                  <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                      <span class="badge badge-pill badge-danger">Error</span>
                                      {{ $error }}
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                      </button>
                                  </div>
                                </div>
                              @endforeach
                              
                            @endif

                            @if(session()->has('success'))

                              <div class="col-md-12">
                                  <div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
                                      <span class="badge badge-pill badge-primary">Success</span>
                                      {{ session('success') }}
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                      </button>
                                  </div>
                              </div>
                            @endif
                            
                              {{-- 
                                'menu_name' => 'required',
                                'menu_price' => 'required',
                                'menu_stocks' => 'required',
                                'menu_available' => 'required',
                                --}}
                            <form action="/admin/menu/update_store" method="post" enctype="multipart/form-data">
                                @csrf
                                
                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                <p><input value="{{ $menu->name }}" type="text" placeholder="Menu name..." name="menu_name" value="{{ old('menu_name') }}"></p>
                                <p><input value="{{ $menu->price }}" type="number" placeholder="Menu price..." name="menu_price" value="{{ old('menu_price') }}"></p>
                                <p><input value="{{ $menu->stocks }}" type="menu_stocks" placeholder="Menu stocks..." name="menu_stocks" value="{{ old('menu_stocks') }}"></p>
                                <label for="menu_available" class="">Menu Available</label>
                                <p>
                                  <select name="menu_available" id="" class="form-control">
                                    <option value="">Select</option>
                                    <option {{ ($menu->available) ? 'selected' : '' }} value="1">Available</option>
                                    <option {{ !($menu->available) ? 'selected' : '' }} value="0">Unavailable</option>
                                  </select>
                                </p>

                                <label for="menu_photo" class="">Menu Photo</label>
                                <p><input type="file" id="menu_photo" name="menu_photo" class="form-control-file"></p>
                                
                                
                                <button type="submit" class="boxed-btn" style="border:none;">Update Pizza</button>
                            </form>
                        </div>
                    </div>
                </div>

               
            </div>


            
        </div>
    </div>
</div>
@endsection