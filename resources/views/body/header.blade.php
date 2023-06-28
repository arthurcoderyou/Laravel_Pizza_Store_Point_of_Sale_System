<!-- header -->
<div class="top-header-area" id="sticker">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-sm-12 text-center">
        <div class="main-menu-wrap">
          <!-- logo -->
          {{-- 
          <div class="site-logo">
            <a href="#">
              <img src="{{ asset('theme/assets/img/logo.png') }}" alt="">
            </a>
          </div>
           --}}
          <!-- logo -->

          <!-- menu start -->
          <nav class="main-menu">
            <ul>
              <li class="current-list-item">
                <a href="/">Home</a>
              </li>
              
              <li>
                @guest
                  <a href="#">Account</a>
                @endguest

                @auth
                  <a href="#">{{ auth()->user()->name }}</a>
                @endauth
                <ul class="sub-menu">
                  @guest
                  <li><a href="/login">Login</a></li>
                  <li><a href="/register">Register</a></li>
                  @endguest
                  @auth
                    <li><a href="#">{{ auth()->user()->email }}</a></li>
                    <li>
                      <form action="/logout" method="post">
                        @csrf

                        <button type="submit" class="text-secondary mr-3" style="font-size: 0.8rem;
                        padding-left: 9px;">Logout</button>
                        
                      </form>
                    </li>
                  @endauth
                </ul>
              </li>

              
                <li>
                  @auth
                    @if(auth()->user()->role == 'user' || auth()->user()->role == 'customer')
                    <a href="#">Shop</a>
                    <ul class="sub-menu">
                      @auth
                        @if(auth()->user()->role == 'admin')
                          <li><a href="/admin/menu/create">Add Shop Pizza</a></li>
                        @endif
                      @endauth
                      <li><a href="/admin/menu/index">Shop</a></li>

                      @php 
                        $color = "warning";
                        $tb_nm = "carts";
                        $con = "null";
                      @endphp

                      <li><a href="/admin/cart/index">Cart <x-badge :user_id="auth()->user()->id" :table_name="$tb_nm" :color="$color" :condition="$con"></x-badge></a></li>
                      
                    </ul>
                    @endif
                  @endauth
                </li>

                <li class="current-list-item">
                  @auth
                    @if(auth()->user()->role == 'user' || auth()->user()->role == 'customer')
                    @php 
                      $color = "info";
                      $tb_nm = "orders";
                      $con = "pending";
                    @endphp
                    <a href="/admin/order/orders">Order <x-badge :user_id="auth()->user()->id" :table_name="$tb_nm" :color="$color" :condition="$con"></x-badge></a>
                    @endif
                  @endauth
                </li>

                <li>
                  @auth
                    @if(auth()->user()->role == 'admin')
                      <a href="#">Transactions</a>
                      <ul class="sub-menu">
                        @php 
                          $color = "info";
                          $tb_nm = "orders";
                          $con = "pending";
                        @endphp
                        <li><a href="/admin/order/pending_orders" >Customer Orders <x-badge :user_id="0" :table_name="$tb_nm" :color="$color" :condition="$con"></x-badge></a></li>

                        @php 
                          $color = "success";
                          $tb_nm = "orders";
                          $con = "completed";
                        @endphp
                        <li><a href="/admin/order/completed_orders">Completed Orders <x-badge :user_id="0" :table_name="$tb_nm" :color="$color" :condition="$con"></x-badge></a></li>

                        @php 
                          $color = "danger";
                          $tb_nm = "orders";
                          $con = "denied";
                        @endphp
                        <li><a href="/admin/order/denied_orders">Denied Orders <x-badge :user_id="0" :table_name="$tb_nm" :color="$color" :condition="$con"></x-badge></a></li>
                        
                      </ul>
                    @endif
                  @endauth
                </li>

                <li class="current-list-item">
                  @auth
                    @if(auth()->user()->role == 'admin')
                      <a href="/admin/sales/sales_report">Sales</a>
                    @endif
                  @endauth
                </li>

                <li>
                  @auth
                    <div class="header-icons">
                      <a class="shopping-cart" href="/admin/cart/index"><i class="fas fa-shopping-cart"></i></a>
                      
                      <a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                    </div>
                  @endauth
                </li>
                
            </ul>
          </nav>
          <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
          <div class="mobile-menu"></div>
          <!-- menu end -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end header -->

<!-- search area -->
<div class="search-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <span class="close-btn"><i class="fas fa-window-close"></i></span>
        <div class="search-bar">
          <div class="search-bar-tablecell">
            <form action="/admin/menu/index" method="post">
              @csrf
              <h3>Search For:</h3>
              <input  name="search_value" type="text" placeholder="Search for Menu...">
              <button type="submit">Search <i class="fas fa-search"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end search area -->