@extends('layouts.main')
@section('content')

<?php 
    $top = "Hi New User :)";
    $main = "Register Account";
?>

<x-page-breadcrumb :top_title="$top" :main_title="$main"></x-page-breadcrumb>

<div class="checkout-section mt-5 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>Register a new account</h5>
                    </div>
                    <div class="card-body">
                        <div class="billing-address-form">
                            <form action="/register" method="post">
                                @csrf
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                <p><input type="text" placeholder="Name" name="name" value="{{ old('name') }}"></p>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                <p><input type="email" placeholder="Email" name="email" value="{{ old('email') }}"></p>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                <p><input type="password" placeholder="Password" name="password"></p>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                <p><input type="password" placeholder="Confirm Password" name="password_confirmation"></p>
                                
                                <button class="boxed-btn" style="border:none;">Register</button>
                            </form>
                        </div>
                    </div>
                </div>

               
            </div>


            
        </div>
    </div>
</div>
@endsection