@extends('layouts.main')
@section('content')
	<!-- hero area -->
	<div class="hero-area hero-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 offset-lg-2 text-center">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Fresh & Yummy</p>
							<h1>Delicious Seasonal Pizzas</h1>
							<div class="hero-btns">
								<a href="/admin/menu/index" class="boxed-btn">Pizza Collection</a>
								@guest
									<a href="/login" class="bordered-btn">Login</a>
								@endguest
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end hero area -->

	<!-- features list section -->
	<div class="list-section pt-80 pb-80">
		<div class="container">

			<div class="row">
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-shipping-fast"></i>
						</div>
						<div class="content">
							<h3>Free Shipping</h3>
							<p>When order over $75</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-phone-volume"></i>
						</div>
						<div class="content">
							<h3>24/7 Support</h3>
							<p>Get support all day</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="list-box d-flex justify-content-start align-items-center">
						<div class="list-icon">
							<i class="fas fa-sync"></i>
						</div>
						<div class="content">
							<h3>Refund</h3>
							<p>Get refund within 3 days!</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- end features list section -->

	<!-- product section -->
	<div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3><span class="orange-text">Our</span> Products</h3>
						<p>We offer quality and deliciuos pizza that you will surely love/p>
					</div>
				</div>
			</div>

			<div class="row">

				@foreach ($products as $product)
					<div class="col-lg-4 col-md-6 text-center">
						<div class="single-product-item">
							<div class="product-image">
								<a href="single-product.html"><img src="{{ (!empty($product->photo)) ? url('uploads/'.$product->photo) : url('uploads/no_image.jpg') }}" alt="menu-photo"></a>
							</div>
							<h3>{{ $product->name }}</h3>
							<p class="product-price"><span>{{ ($product->available) ? 'Available' : 'Unavailable' }}</span> <span>{{ $product->stocks }} in stocks</span> P {{ $product->price }} </p>
							<a href="/admin/menu/index" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
						</div>
					</div>
				@endforeach
				

				

			</div>

			<div class="row">
				<div class="col-sm-12 text-center">
					<a href="#" class="cart-btn"><i class="fas fa-heart"></i>All Pizza's</a>
				</div>
				
			</div>

		</div>
	</div>
	<!-- end product section -->
@endsection