<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>index</title>
	<link rel="shortcut icon" type="image/x-icon" href={{asset('store_front/images/favicon.ico')}}>
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href={{asset('store_front/css/animate.css')}}>
	<link rel="stylesheet" type="text/css" href={{asset('store_front/css/font-awesome.min.css')}}>
	<link rel="stylesheet" type="text/css" href={{asset('store_front/css/bootstrap.min.css')}}>
	<link rel="stylesheet" type="text/css" href={{asset('store_front/css/owl.carousel.min.css')}}>
	<link rel="stylesheet" type="text/css" href={{asset('store_front/css/chosen.min.css')}}>
	<link rel="stylesheet" type="text/css" href={{asset('store_front/css/style.css')}}>
	<link rel="stylesheet" type="text/css" href={{asset('store_front/css/color-01.css')}}>
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <meta name="BASE_URL" content="{{ url('/') }}">
    @yield('css')
</head>
<body class="home-page home-01 ">

	<!-- mobile menu -->
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
        </div>
        <div class="mercado-panels"></div>
    </div>

	<!--header-->
	<header id="header" class="header header-style-1">
		<div class="container-fluid">
			<div class="row">

				<div class="topbar-menu-area">
					<div class="container">

						<div class="topbar-menu right-menu">
							<ul>


								<li class="menu-item notAuth "  ><a title="Register or Login" href={{route('user-login')}}>الدخول</a></li>
								<li class="menu-item notAuth " ><a title="Register or Login" href={{route('user-register')}}>التسجيل في الموقع</a></li>
								{{-- <li class="menu-item menu-item-has-children parent" >
									<a title="My Account" href="#">My Account (Admin)<i class="fa fa-angle-down" aria-hidden="true"></i></a>
									<ul class="submenu curency" >
										<li class="menu-item"><a href="#">Products</a></li>
										<li class="menu-item"><a href="#">Categories</a></li>
										<li class="menu-item"><a href="#">Coupons</a></li>
										<li class="menu-item"><a href="#">Orders</a></li>
										<li class="menu-item"><a href="#">Customers</a></li>
										<li class="menu-item" ><a title="Logout" href="#">Logout</a></li>
									</ul>
								</li> --}}
								<li class="menu-item menu-item-has-children parent auth" >
									<a title="My Account" href="#">My Account (User)<i class="fa fa-angle-down" aria-hidden="true"></i></a>
									<ul class="submenu curency" >
										<li class="menu-item"><a href={{route('user-orders')}}>Orders</a></li>
										<li class="menu-item"><a href={{route('edit-profile')}}>Account Details</a></li>
										<li class="menu-item" ><a id="logout" title="Logout" href="#">Logout</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="mid-section main-info-area">

						<div class="wrap-logo-top left-section">
							<a href="index.html" class="link-to-home"><img src={{asset('store_front/images/products/logo88.png')}} alt="mercado"></a>
						</div>

						<div class="wrap-search center-section">
							<div class="wrap-search-form">
								<form action="#" id="form-search-top" name="form-search-top">
									<input type="text" name="search" value="" placeholder="Search here...">
									<button form="form-search-top" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
									<div class="wrap-list-cate">
										<input type="hidden" name="product-cate" value="0" id="product-cate">
										<a href="#" class="link-control">المنتجات</a>
										<ul class="list-cate">
											<li class="level-0">جميع المنتجات</li>
											<li class="level-1">العطور الرجالية</li>
											<li class="level-2">العطور النسائية</li>

										</ul>
									</div>
								</form>
							</div>
						</div>

						<div class="wrap-icon right-section auth">
							<div class="wrap-icon-section wishlist">
								<a href="#" class="link-direction">


								</a>
							</div>
                            <div class="wrap-icon-section minicart auth">
                            @if (auth()->user() && auth()->user()->has_order )
                                    <a href={{route('cart')}} class="link-direction">
                                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                        <div class="left-info">
                                            <span class="index"><?php if(auth()->user()) echo auth()->user()->product_cart ?> items</span>
                                            <span class="title">CART</span>
                                        </div>
                                    </a>
                                    @endif
                            </div>
							<div class="wrap-icon-section show-up-after-1024">
								<a href="#" class="mobile-navigation">
									<span></span>
									<span></span>
									<span></span>
								</a>
							</div>
						</div>

					</div>
				</div>

				<div class="nav-section header-sticky">
					<div class="header-nav-section">
						<div class="container">
							<ul class="nav menu-nav clone-main-menu" id="mercado_haead_menu" data-menuname="Sale Info" >
								<ol class=""><a href="#" class=""> </a></ol>
								<li class=""><a href={{route('home')}} class=""> الصفحة الرئيسية</a></li>
								<li class=""><a href={{route('man-store')}} class="">العطور الرجالية</a></li>
								<li class=""><a href={{route('woman-store')}} class="">العطور النسائية</a></li>
								<li class=""><a href={{route('cart')}} class="">عربة التسوق </a></li>
								{{-- <li class=""><a href="contact-us.html" class=""> ما رأيك بالمنتجات؟  </a></li> --}}
							</ul>
						</div>
					</div>



	</header>

        @yield('contnet')

	<footer id="footer">
		<div class="wrap-footer-content footer-style-1">

			<div class="wrap-function-info">
				<div class="container">
					<ul>
						<li class="fc-info-item">
							<i class="" aria-hidden="true"></i>
							<div class="wrap-left-info">

							</div>

						</li>
						<li class="fc-info-item">
							<i class="" aria-hidden="true"></i>
							<div class="wrap-left-info"> <h4 class="fc-name">
									تواصل معنا
								</h4>
								<br>
								<br>

								<p class="fc-desc">
									<a href="#" class="link-to-item" title="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
									<a href="#" class="link-to-item" title="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
									<a href="#" class="link-to-item" title="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></p>
							</div>

						</li>
						<li class="fc-info-item">
							<i  aria-hidden="true"></i>
							<div class="wrap-left-info">

							</div>

						</li>
						<li class="fc-info-item">
							<i aria-hidden="true"></i>
							<div class="wrap-left-info">
								<h4 class="fc-name">من نحن</h4>
								<p class="fc-desc">
									لدينا افضل متجر عطور مستوحاة من أفخم انواع العطر الرجالي والنسائية الشرقية والعالمية لنضع بين يديك افضل واجود ما تم الوصول له في عالم العطور المستوحاة</p>
							</div>

						</li>
					</ul>
				</div>
			</div>
			<!--End function info-->

			<div class="main-footer-content">

				<div class="container">

					<div class="row">

						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">


					<div class="row">

						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
							<div class="wrap-footer-item">
								<h3 class="item-header">We Using Safe Payments:</h3>
								<div class="item-content">
									<div class="wrap-list-item wrap-gallery">
										<img src={{asset('store_front/images/payment.png')}} style="max-width: 260px;">
									</div>
								</div>
							</div>
						</div>



						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">

						</div>

					</div>
				</div>

				<div class="wrap-back-link">
					<div class="container">



							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="coppy-right-box">
				<div class="container">
					<div class="coppy-right-item item-left">
						<p class="coppy-right-text">Copyright © 2020 Surfside Media. All rights reserved</p>
					</div>
					<div class="coppy-right-item item-right">
						<div class="wrap-nav horizontal-nav">
							<ul>
								<li class="menu-item"><a href="about-us.html" class="link-term">About us</a></li>
								<li class="menu-item"><a href="privacy-policy.html" class="link-term">Privacy Policy</a></li>
								<li class="menu-item"><a href="terms-conditions.html" class="link-term">Terms & Conditions</a></li>
								<li class="menu-item"><a href="return-policy.html" class="link-term">Return Policy</a></li>
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</footer>
    <script src="{{ asset('core/jquery.min.js') }}"></script>

	<script src={{asset('store_front/js/jquery-1.12.4.minb8ff.js?ver=1.12.4')}}></script>
	<script src={{asset('store_front/js/bootstrap.min.js')}}></script>
	<script src={{asset('store_front/js/chosen.jquery.min.js')}}></script>
	<script src={{asset('store_front/js/owl.carousel.min.js')}}></script>
	<script src={{asset('store_front/js/jquery.countdown.min.js')}}></script>
	<script src={{asset('store_front/js/jquery.sticky.js')}}></script>
	<script src={{asset('store_front/js/functions.js')}}></script>

    <script src="{{ asset('core/http.js') }}"></script>
    <script src="{{ asset('core/sweetalert.min.js') }}"></script>
    <script src="{{ asset('core/global.js') }}"></script>
    <script src="{{ asset('core/jquery.min.js') }}"></script>
	<!--footer area-->
    @yield('js');
    <script>$user_id = "{{auth()->user()?? null}}"</script>
    <script>
        if(!$user_id){
            $('.auth').css('display', 'none');
        }else{
            $('.notAuth').css('display', 'none');
        }
    </script>
</body>
</html>
