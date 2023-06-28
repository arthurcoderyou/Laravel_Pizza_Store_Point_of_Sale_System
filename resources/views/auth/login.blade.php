@extends('layouts.main')
@section('content')

<?php 
    $top = "Hi There :)";
    $main = "Login Account";
?>

<x-page-breadcrumb :top_title="$top" :main_title="$main"></x-page-breadcrumb>

<div class="checkout-section mt-5 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>Log in to you account</h5>
                    </div>
                    <div class="card-body">
                        <div class="billing-address-form">
                            <form action="/login" method="post">
                                @csrf
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                <p><input type="email" placeholder="Email" name="email" value="{{ old('email') }}"></p>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                <p><input type="password" placeholder="Password" name="password"></p>
                                
                                <div class="block mt-4">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div>
                                
                                <button class="boxed-btn" style="border:none;">Login</button>
                            </form>
                        </div>
                    </div>
                </div>

               
            </div>


            
        </div>
    </div>
</div>
@endsection