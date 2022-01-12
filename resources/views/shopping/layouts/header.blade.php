<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li>
                                @auth
                                <p>Welcome: {{ auth()->user()->name }}</p>
                                @endauth
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->
    
    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-md-4 clearfix">
                    <div class="logo pull-left">
                        <a href="{{ route('shopping.home') }}"><img src="images/home/logo.png" alt="" /></a>
                    </div>
                    
                </div>
                <div class="col-md-8 clearfix">
                    <div class="shop-menu clearfix pull-right">
                        <ul class="nav navbar-nav">
                            @auth
                            <li><a href=""><i class="fa fa-user"></i> Account</a></li>
                            <li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
                            <li><a href="{{ route('shopping.checkout') }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li><a href="{{ route('shopping.cart') }}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                            <li><a href="{{ route('shopping.logout') }}"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                            @else
                            <li><a href="{{ route('shopping.login') }}"><i class="fa fa-lock"></i> Login</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{ route('shopping.home') }}" class="active">Home</a></li>
                            <li class="dropdown"><a href="/">Shop</a>
                                {{-- <ul role="menu" class="sub-menu">
                                    <li><a href="{{ route('shopping.products') }}">Products</a></li>
                                    <li><a href="{{ route('shopping.product_details') }}">Product Details</a></li> 
                                    <li><a href="{{ route('shopping.checkout') }}">Checkout</a></li> 
                                    <li><a href="{{ route('shopping.cart') }}">Cart</a></li> 
                                    <li><a href="{{ route('shopping.login') }}">Login</a></li> 
                                </ul> --}}
                            </li> 
                            <li class="dropdown"><a href="{{ route('shopping.blog_list') }}">Blog</a>
                                {{-- <ul role="menu" class="sub-menu">
                                    <li><a href="">Blog List</a></li>
                                    <li><a href="{{ route('shopping.blog_single') }}">Blog Single</a></li>
                                </ul> --}}
                            </li> 
                            <li><a href="{{ route('shopping.contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Search"/>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->