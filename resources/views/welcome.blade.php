<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Start Meta -->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="description" content="POINTCUT"/>
	<meta name="keywords" content="Creative, Digital, multipage, landing, freelancer template"/>
	<meta name="author" content="ThemeOri">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Title of Site -->
	<title>POINTCUT</title>
	<!-- Favicons -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('template/landing/assets/css/bootstrap.min.css') }}">
    <!-- font awesome -->
    <link rel="stylesheet" href="{{ asset('template/landing/assets/css/all.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('template/landing/assets/css/animate.css') }}">
    <!-- Swiper -->
    <link rel="stylesheet" href="{{ asset('template/landing/assets/css/swiper-bundle.min.css') }}">
    <!-- Magnific -->
    <link rel="stylesheet" href="{{ asset('template/landing/assets/css/magnific-popup.css') }}">
    <!-- Mean menu -->
    <link rel="stylesheet" href="{{ asset('template/landing/assets/css/meanmenu.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('template/landing/assets/sass/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />

    <link rel="stylesheet" href="{{ asset('template/admin/vendor/select2/css/select2.min.css') }}">

      
    <link href="{{ asset('template/admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('template/admin/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/admin/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template/admin/vendor/select2/css/select2.min.css') }}">
    <!-- tagify-css -->

    <link href="{{ asset('template/admin/vendor/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('template/admin/vendor/clockpicker/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/admin/vendor/jquery-asColorPicker/css/asColorPicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/admin/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
    
    <link href="{{ asset('template/admin/vendor/pickadate/themes/default.css') }}" rel="stylesheet">
    <link href="{{ asset('template/admin/vendor/pickadate/themes/default.date.css') }}" rel="stylesheet">
    <link href="{{ asset('template/admin/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css') }}" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        /* HIDE RADIO */
        [type=radio] { 
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
        }

        /* IMAGE STYLES */
        [type=radio] + img {
        cursor: pointer;
        }

        /* CHECKED STYLES */
        [type=radio]:checked + img {
        outline: 2px solid #222B40;
        }
    </style>


</head>

<body>
	<!-- Preloader start -->
	<div class="theme-loader">
		<div class="spinner">
			<div class="double-bounce1"></div>
			<div class="double-bounce2"></div>
		</div>
	</div>
	<!-- Preloader end -->
	<!-- Header Area Start -->
	<div class="header__sticky one">
		<div class="header__area three">
			<div class="container custom__container">
				<div class="header__area-menubar">
					<div class="header__area-menubar-left">
						<div class="header__area-menubar-left-logo">
							<a href="{{route('home')}}"><h3 class="text-white">POINTCUT</h3></a>
							<div class="responsive-menu"></div>
						</div>
					</div>
					<div class="header__area-menubar-right three">
						<div class="header__area-menubar-right-menu menu-responsive">						
							<ul id="mobilemenu">
								{{-- <li class="menu-item-has-children"><a href="#">Home</a>
									<ul class="sub-menu">
										<li><a href="index.html">Home 01</a></li>
										<li><a href="index-2.html">Home 02</a></li>
										<li><a href="index-3.html">Home 03</a></li>									
									</ul>
								</li> --}}
								<li><a href="#for-booking">Booking</a></li>
								<li><a href="#for-booking">Services</a></li>
								<li><a href="#for-visi">Visi Misi</a></li>
								
								{{-- <li class="menu-item-has-children"><a href="#">Shop</a>
									<ul class="sub-menu">
										<li><a href="product-page.html">Product Page</a></li>
										<li><a href="product-details.html">Product Details</a></li>
										<li><a href="cart.html">Cart</a></li>
										<li><a href="checkout.html">Checkout</a></li>
									</ul>
								</li>
								<li class="menu-item-has-children"><a href="#">Blog</a>
									<ul class="sub-menu">
										<li><a href="blog-grid.html">Blog Grid</a></li>
										<li><a href="blog-standard.html">Blog Standard</a></li>
										<li><a href="blog-details.html">Blog Details</a></li>
									</ul>
								</li> --}}
								<li><a href="#for-contact">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="header__area-menubar-right-box">
						{{-- <div class="header__area-menubar-right-box-search">
							<div class="search">	
								<span class="header__area-menubar-right-box-search-icon three open"><i class="fal fa-search"></i></span>
							</div>
							<div class="header__area-menubar-right-box-search-box">
								<form>
									<input type="search" placeholder="Search Here.....">
									<button type="submit"><i class="fal fa-search"></i>
									</button>
								</form> <span class="header__area-menubar-right-box-search-box-icon"><i class="fal fa-times"></i></span>
							</div>
						</div> --}}
						<div class="header__area-menubar-right-box-sidebar">
                            @auth 
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="text-white my-3">Hai {{ Auth::user()->name }}</h5>
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-white">
                                            <span>Logout </span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                         
                           
                            @endauth
                            @guest
                            <a  href="{{ route('login') }}" class="text-white">
                                <span>Login </span>
                            </a>
                            @endguest
						</div>
						<!-- sidebar Menu Start -->
						<div class="header__area-menubar-right-box-sidebar-popup three">
							<div class="sidebar-close-btn"><i class="fal fa-times"></i></div>
							<div class="header__area-menubar-right-box-sidebar-popup-logo">
								<a href="index.html"> <img src="assets/img/logo.png" alt=""> </a>
							</div>
							<p>Haircut" is a term used to describe when a person removes the hair on their head. This is done to allow for better access to the part of the body that needs cutting.</p>
							<div class="header__area-menubar-right-box-sidebar-popup-image">
								<img src="assets/img/bar.jpg" alt="">
							</div>
							<div class="header__area-menubar-right-box-sidebar-popup-contact">
								<h4 class="mb-30">Contact Info</h4>
								<div class="header__area-menubar-right-box-sidebar-popup-contact-item">
									<div class="header__area-menubar-right-box-sidebar-popup-contact-item-icon">
										<i class="fal fa-phone-alt"></i>
									</div>
									<div class="header__area-menubar-right-box-sidebar-popup-contact-item-content">
										<span>Call Now</span>
										<h6><a href="tel:+125(895)658568">+125 (895) 658 568</a></h6>
									</div>
								</div>
								<div class="header__area-menubar-right-box-sidebar-popup-contact-item">
									<div class="header__area-menubar-right-box-sidebar-popup-contact-item-icon">
										<i class="fal fa-envelope"></i>
									</div>
									<div class="header__area-menubar-right-box-sidebar-popup-contact-item-content">
										<span> Quick Email</span>
										<h6><a href="mailto:info.help@gmail.com">info.help@gmail.com</a></h6>
									</div>
								</div>
								<div class="header__area-menubar-right-box-sidebar-popup-contact-item">
									<div class="header__area-menubar-right-box-sidebar-popup-contact-item-icon">
										<i class="fal fa-map-marker-alt"></i>
									</div>
									<div class="header__area-menubar-right-box-sidebar-popup-contact-item-content">
										<span> Office Address</span>
										<h6><a href="#">PV3M+X68 Welshpool United Kingdom</a></h6>
									</div>
								</div>
							</div>
							<div class="header__area-menubar-right-box-sidebar-popup-social">
								<ul>
									<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
									<li><a href="#"><i class="fab fa-behance"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter"></i></a></li>
									<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
								</ul>							
							</div>
						</div>
						<div class="sidebar-overlay"></div>
						<!-- sidebar Menu Start -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Header Area End -->
	<!-- Banner Three Area Start -->
    <div class="banner__three" data-background="{{ asset('template/landing/assets/img/bg/banner-bg-3.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <div class="banner__three-title">
                        <span class="subtitle__one">Welcome to Our POINCUT</span>
                        <h1>Best Haircut Salon in the City</h1>
                        <p>Phasellus vitae purus ac urna consequat facilisis a vel leo. Maecenas hendrerit lacinia mollis.</p>
                        <a href="#for-booking" class="theme-banner-btn">Booking Now<i class="far fa-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner__three-right">
            <img src="assets/img/bg/banner-3.png" alt="">
        </div>
    </div>
	<!-- Banner Three Area End -->    
	<!-- Services Three Start -->	
	<div class="services__three section-padding">
		<div class="container">
			<div class="row mb-65">
				<div class="col-xl-12">
					<div class="services__three-title">
						<span class="subtitle__one">Services</span>
						<h2>Popular Services</h2>
					</div>					
				</div>
			</div>
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6 xl-mb-30">
                    <div class="services__three-item">
                        <div class="services__three-item-icon download">
                            <img src="{{asset('template/landing/assets/img/icon/services-1.png')}}" alt="">
                        </div>
                        <div class="services__three-item-content">
                            <h4><a href="#" class="services">Trend Haircut</a></h4>
                            {{-- <p>Fusce ornare commodo leo, id maximus ex consequat nec. Cras sed arcu vel eros</p> --}}
                            {{-- <a href="#" class="simple-btn">Read More<i class="far fa-angle-double-right"></i></a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 md-mb-30">
                    <div class="services__three-item">
                        <div class="services__three-item-icon download">
                            <img src="{{asset('template/landing/assets/img/icon/services-2.png')}}" alt="">
                        </div>
                        <div class="services__three-item-content">
                            <h4><a href="#">Hair Washing</a></h4>
                            {{-- <p>Fusce ornare commodo leo, id maximus ex consequat nec. Cras sed arcu vel eros</p> --}}
                            {{-- <a href="#" class="simple-btn">Read More<i class="far fa-angle-double-right"></i></a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 md-mb-30">
                    <div class="services__three-item">
                        <div class="services__three-item-icon download">
                            <img src="{{asset('template/landing/assets/img/icon/services-3.png')}}" alt="">
                        </div>
                        <div class="services__three-item-content">
                            <h4><a href="#">Hair Coloring</a></h4>
                            {{-- <p>Fusce ornare commodo leo, id maximus ex consequat nec. Cras sed arcu vel eros</p> --}}
                            {{-- <a href="#" class="simple-btn">Read More<i class="far fa-angle-double-right"></i></a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="services__three-item">
                        <div class="services__three-item-icon download">
                            <img src="{{asset('template/landing/assets/img/icon/services-4.png')}}" alt="">
                        </div>
                        <div class="services__three-item-content">
                            <h4><a href="#">Facial hair Trim</a></h4>
                            {{-- <p>Fusce ornare commodo leo, id maximus ex consequat nec. Cras sed arcu vel eros</p> --}}
                            {{-- <a href="#" class="simple-btn">Read More<i class="far fa-angle-double-right"></i></a> --}}
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<!-- Services Three End -->
	<!-- About Three Start -->
    {{-- <div class="about__three section-padding pt-0">
        <div class="container">
            <div class="row">
				<div class="col-xl-7 col-lg-6 lg-mb-30">
					<div class="about__three-left">
						<div class="about__three-left-image">
							<img src="assets/img/about/about-7.jpg" alt="">
						</div>
						<div class="about__three-left-play-icon video-pulse">
							<a class="video-popup" href="https://www.youtube.com/watch?v=0WC-tD-njcA"><i class="fas fa-play"></i></a> 
						</div>
					</div>
				</div>
				<div class="col-xl-5 col-lg-6">
                    <div class="about__three-right ml-25 xl-ml-0">
                        <div class="about__three-right-title">
							<span class="subtitle__one">About Us</span>
							<h2>The Best Barber Trending Style</h2>
							<p>Haircut" is a term used to describe when a person removes the hair on their head. This is done to allow for better</p>
							<a href="about.html" class="theme-banner-btn">Read More<i class="far fa-angle-double-right"></i></a>
						</div>
                    </div>					
				</div>
            </div>
			<div class="about__three-counter">
				<div class="row">
					<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 lg-mb-30">
						<div class="about__three-counter-item">
							<div class="about__three-counter-item-icon">
								<img src="assets/img/icon/9.png" alt="">
							</div>
							<div class="about__three-counter-item-content">
								<h2><span class="counter">150</span>K</h2>
								<p>Happy Customers</p>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 sm-mb-30">
						<div class="about__three-counter-item">
							<div class="about__three-counter-item-icon">
								<img src="assets/img/icon/services-1.png" alt="">
							</div>
							<div class="about__three-counter-item-content">
								<h2><span class="counter">668</span>K</h2>
								<p>Customer Haircut</p>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 sm-mb-30">
						<div class="about__three-counter-item">
							<div class="about__three-counter-item-icon">
								<img src="assets/img/icon/9.png" alt="">
							</div>
							<div class="about__three-counter-item-content">
								<h2><span class="counter">50</span>K</h2>
								<p>Our Salons</p>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
						<div class="about__three-counter-item">
							<div class="about__three-counter-item-icon">
								<img src="assets/img/icon/9.png" alt="">
							</div>
							<div class="about__three-counter-item-content">
								<h2><span class="counter">10</span>K</h2>
								<p>Customers</p>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div> --}}
	<!-- About Three End -->
	<!-- Gallery Area Start -->
	{{-- <div class="gallery__area section-padding">
		<div class="container">
			<div class="row mb-65">
				<div class="col-xl-12">
					<div class="gallery__area-title">
						<span class="subtitle__two">Gallery</span>
						<span class="subtitle__one">Our Gallery</span>
						<h2>We Have Done Lots Of Projects Let'see Our Gallery</h2>
					</div>					
				</div>
			</div>
			<div class="row mb-65">
				<div class="col-xl-3 col-lg-5 mb-30">
					<div class="gallery__area-item">
						<div class="gallery__area-item-image"> 
							<img class="img__full" src="assets/img/features/gallery-1.jpg" alt="">
							<div class="gallery__area-item-image-content">
								<h4>Trending Haircut</h4>
								<span>Haircut salon</span>
							</div>
						</div>
					</div>
				</div>				
				<div class="col-xl-6 col-lg-7 lg-mb-30">
					<div class="gallery__area-item">
						<div class="gallery__area-item-image"> 
							<img src="assets/img/features/gallery-2.jpg" alt="">
							<div class="gallery__area-item-image-content">
								<h4>Trending Haircut</h4>
								<span>Haircut salon</span>
							</div>
						</div>
					</div>
				</div>				
				<div class="col-xl-3 col-lg-5 xl-mb-30">
					<div class="gallery__area-item">
						<div class="gallery__area-item-image"> 
							<img class="img__full" src="assets/img/features/gallery-3.jpg" alt="">
							<div class="gallery__area-item-image-content">
								<h4>Trending Haircut</h4>
								<span>Haircut salon</span>
							</div>
						</div>
					</div>
				</div>				
				<div class="col-xl-6 col-lg-7 col-md-6 lg-mb-30">
					<div class="gallery__area-item">
						<div class="gallery__area-item-image"> 
							<img src="assets/img/features/gallery-4.jpg" alt="">
							<div class="gallery__area-item-image-content">
								<h4>Trending Haircut</h4>
								<span>Haircut salon</span>
							</div>
						</div>
					</div>
				</div>				
				<div class="col-xl-6 col-md-6">
					<div class="gallery__area-item">
						<div class="gallery__area-item-image"> 
							<img class="img__full" src="assets/img/features/gallery-5.jpg" alt="">
							<div class="gallery__area-item-image-content">
								<h4>Trending Haircut</h4>
								<span>Haircut salon</span>
							</div>
						</div>
					</div>
				</div>				
			</div>
			<div class="row t-center">
				<div class="col-xl-12">
					<a href="about.html" class="theme-banner-btn">Read More<i class="far fa-angle-double-right"></i></a>
				</div>
			</div>
		</div>
	</div> --}}
	<!-- Gallery Area End -->
	{{-- <img class="img__full" src="assets/img/features/bg.jpg" alt=""> --}}
	<!-- FAQ Area Start -->
	<div class="faq__area section-padding" id="for-visi" >
		<div class="container">
			<div class="row align-items-center">
				<div class="col-xl-5 col-lg-6 lg-mb-30">
					<div class="faq__area-title">
						<span class="subtitle__two">Visi Misi</span>
						<span class="subtitle__one">POINTCUT</span>
						<h2>Visi Misi</h2>
						<p>Fusce ornare commodo leo, id maximus ex consequat nec. Cras sed arcu vel eros accumsan tincidunt maximus eget lectus. Nullam sed ipsum mauris. Nam a nisl et lacus pretium porttitor.</p>						
						<div class="faq__area-title-shape">
							<img src="assets/img/shape/faq.png" alt="">
						</div>
					</div>
				</div>
				<div class="col-xl-7 col-lg-6">
					<div class="faq__area-left">
						<div class="faq__area-left-item">
							<div class="faq__area-left-item-card">
								<div class="faq__area-left-item-card-header">
									<h5>What should you not ask your hairdresser?</h5> <i class="fal fa-plus"></i> </div>
								<div class="faq__area-left-item-card-header-content display-none">
									<p>Fusce ornare commodo leo, id maximus ex consequat nec. Cras sed arcu vel eros accumsan tincidunt maximus eget lectus. Nullam sed ipsum mauris. Nam a nisl et lacus pretium porttitor.</p>
								</div>
							</div>
						</div>
						<div class="faq__area-left-item">
							<div class="faq__area-left-item-card">
								<div class="faq__area-left-item-card-header">
									<h5>What are the 5 management tips in a salon?</h5> <i class="fal fa-minus"></i> </div>
								<div class="faq__area-left-item-card-header-content active">
									<p>Fusce ornare commodo leo, id maximus ex consequat nec. Cras sed arcu vel eros accumsan tincidunt maximus eget lectus. Nullam sed ipsum mauris. Nam a nisl et lacus pretium porttitor.</p>
								</div>
							</div>
						</div>
						<div class="faq__area-left-item">
							<div class="faq__area-left-item-card">
								<div class="faq__area-left-item-card-header">
									<h5>Protect Your Business with Insurance?</h5> <i class="fal fa-plus"></i> </div>
								<div class="faq__area-left-item-card-header-content display-none">
									<p>Fusce ornare commodo leo, id maximus ex consequat nec. Cras sed arcu vel eros accumsan tincidunt maximus eget lectus. Nullam sed ipsum mauris. Nam a nisl et lacus pretium porttitor.</p>
								</div>
							</div>
						</div>
						<div class="faq__area-left-item">
							<div class="faq__area-left-item-card">
								<div class="faq__area-left-item-card-header">
									<h5>What should you not ask your hairdresser?</h5> <i class="fal fa-plus"></i> </div>
								<div class="faq__area-left-item-card-header-content display-none">
									<p>Fusce ornare commodo leo, id maximus ex consequat nec. Cras sed arcu vel eros accumsan tincidunt maximus eget lectus. Nullam sed ipsum mauris. Nam a nisl et lacus pretium porttitor.</p>
								</div>
							</div>
						</div>
						<div class="faq__area-left-item">
							<div class="faq__area-left-item-card">
								<div class="faq__area-left-item-card-header">
									<h5>How can I make my salon run smoother?</h5> <i class="fal fa-plus"></i> </div>
								<div class="faq__area-left-item-card-header-content display-none">
									<p>Fusce ornare commodo leo, id maximus ex consequat nec. Cras sed arcu vel eros accumsan tincidunt maximus eget lectus. Nullam sed ipsum mauris. Nam a nisl et lacus pretium porttitor.</p>
								</div>
							</div>
						</div>
						<div class="faq__area-left-item">
							<div class="faq__area-left-item-card">
								<div class="faq__area-left-item-card-header">
									<h5>Open a Business Bank Account?</h5> <i class="fal fa-plus"></i> </div>
								<div class="faq__area-left-item-card-header-content display-none">
									<p>Fusce ornare commodo leo, id maximus ex consequat nec. Cras sed arcu vel eros accumsan tincidunt maximus eget lectus. Nullam sed ipsum mauris. Nam a nisl et lacus pretium porttitor.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- FAQ Area End -->	
	<!-- Instagram Area Start -->	
	{{-- <div class="instagram__area two">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-2 col-sm-4 pl-5 pr-5 lg-mb-10">
					<div class="instagram__area-item">
						<img src="assets/img/features/instagram-7.jpg" alt="">
						<div class="instagram__area-item-icon">
							<a href="#"><i class="fab fa-instagram"></i></a>
						</div>
					</div>					
				</div>
				<div class="col-lg-2 col-sm-4 pl-5 pr-5 sm-mb-10">
					<div class="instagram__area-item">
						<img src="assets/img/features/instagram-8.jpg" alt="">
						<div class="instagram__area-item-icon">
							<a href="#"><i class="fab fa-instagram"></i></a>
						</div>
					</div>					
				</div>
				<div class="col-lg-2 col-sm-4 pl-5 pr-5 sm-mb-10">
					<div class="instagram__area-item">
						<img src="assets/img/features/instagram-9.jpg" alt="">
						<div class="instagram__area-item-icon">
							<a href="#"><i class="fab fa-instagram"></i></a>
						</div>
					</div>					
				</div>
				<div class="col-lg-2 col-sm-4 pl-5 pr-5 sm-mb-10">
					<div class="instagram__area-item">
						<img src="assets/img/features/instagram-10.jpg" alt="">
						<div class="instagram__area-item-icon">
							<a href="#"><i class="fab fa-instagram"></i></a>
						</div>
					</div>					
				</div>
				<div class="col-lg-2 col-sm-4 pl-5 pr-5 sm-mb-10">
					<div class="instagram__area-item">
						<img src="assets/img/features/instagram-11.jpg" alt="">
						<div class="instagram__area-item-icon">
							<a href="#"><i class="fab fa-instagram"></i></a>
						</div>
					</div>					
				</div>
				<div class="col-lg-2 col-sm-4 pl-5 pr-5">
					<div class="instagram__area-item">
						<img src="assets/img/features/instagram-12.jpg" alt="">
						<div class="instagram__area-item-icon">
							<a href="#"><i class="fab fa-instagram"></i></a>
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div> --}}
	<!-- Instagram Area End -->	    
	<!-- Newsletter Area Start -->
    {{-- <div class="newsletter__area">
        <div class="container">
            <div class="row align-items-center">
                {{-- <div class="col-xl-7 col-lg-7 lg-mb-30">
                    <div class="newsletter__area-left">
                        <h2>Subscribe Our Newsletter</h2>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5">
                    <div class="newsletter__area-right">
						<form action="#">
							<input type="text" placeholder="Email Address">
							<button type="submit"><i class="fal fa-hand-pointer"></i></button>
						</form>
                    </div>
                </div> --}}

            {{-- </div>
        </div>
    </div>      --}}
    <div class="contact__area section-padding" id="for-booking">
		<div class="container">
			<div class="row mb-60">
				<div class="col-xl-5 col-lg-6">
					<div class="contact__area-title">
                        <span class="subtitle__one">Contact</span>
						<h2>Need Yor any help Contact with Us</h2> 
                    </div>
                    <div class="contact__area-info">
                        <div class="contact__area-info-item">
                            <div class="contact__area-info-item-icon">
                                <i class="far fa-phone-alt"></i>
                            </div>
                            <div class="contact__area-info-item-content">
								<span>Emergency Help</span>
                                <h5><a href="tel:+123(458)896895">+123 ( 458 ) 896 895</a></h5>
                            </div>
                        </div>
                        <div class="contact__area-info-item">
                            <div class="contact__area-info-item-icon">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <div class="contact__area-info-item-content">
								<span>Quick Email</span>
                                <h5><a href="mailto:support@gamil.com">supportpointcut@gamil.com</a></h5>
                            </div>
                        </div>
                        <div class="contact__area-info-item">
                            <div class="contact__area-info-item-icon">
                                <i class="far fa-map-marker-alt"></i>
                            </div>
                            <div class="contact__area-info-item-content">
								<span>Office Address</span>
                                <h5><a href="#">66W3+Q4G Buxton, United Kingdom</a></h5>
                            </div>
                        </div>
                    </div>
				</div>
                <div class="col-xl-7 col-lg-6">
                    @auth
                    <div class="contact__area-title">
                        <span class="subtitle__one">Booking</span>
                        <h3>Hello {{ Auth::user()->name }}!</h3>
                    </div>
                
                    <div class="row mt-2">
                        <div class="col-sm-12 mb-30">
                            <div class="contact__area-bottom-form-item">
                                <select id="form-service"  style="width: 100%">

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-30">
                            <div class="contact__area-bottom-form-item">
                                <input type="text" class="form-control" placeholder="choose a date" id="min-date" style="height:30px">
                            </div>
                        </div>
                        <div class="col-sm-12 mb-30">
                            <div class="contact__area-bottom-form-item">
                                <select id="form-time" style="width: 100%">

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-30">
                            <div class="contact__area-bottom-form-item">
                                <div id="list_employee" class="row">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="contact__area-bottom-form-item">
                                <button class="theme-banner-btn" id="book-btn">Booking Now<i class="far fa-angle-double-right"></i></button>
                            </div>
                        </div>
                    </div>
                    @endauth
                    @guest
                    <div class="contact__area-title">
                        <span class="subtitle__one">Booking</span>
                        <h3>If you want to booking, please click login below!</h3>
                    </div>
                    
                    <a href="{{ route('login') }}" class="theme-banner-btn">
                        <span >Login </span>
                    </a>
                    @endguest
                </div>
			</div>
		
		</div>

	</div>
    <div class="row"><div id="map" style="height: 350px; width:100%; border-radius:12px"></div></div>
	<!-- Newsletter Area End -->
	<!-- Footer Two Start -->	
	<div id="for-contact" class="footer__two">
		<div class="footer__area-shape">
			<img src="assets/img/shape/foorer.png" alt="">
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xl-4 col-lg-3 col-md-4 col-sm-8 sm-mb-30">
					<div class="footer__two-widget">
						<div class="footer__two-widget-logo">
							<a href="index.html"><img src="assets/img/logo.png" alt=""></a>								
						</div>
                        <h5 class="mt-5">POINTCUT</h5>
					</div>
				</div>
				{{-- <div class="col-xl-3 col-lg-2 col-md-3 col-sm-4 lg-mb-30">
					<div class="footer__two-widget pl-25 xl-pl-0">
						<h5>Services</h5>
                        <div class="footer__two-widget-menu">
                            <ul>
                                <li><a href="services-details.html">Haircut</a></li>
                                <li><a href="services-details.html">Hair Washing</a></li>
                                <li><a href="services-details.html">Hair Coloring</a></li>
                                <li><a href="services-details.html">Facial hair Trim</a></li>
                            </ul>
                        </div>
					</div>
				</div> --}}
				<div class="col-xl-4 col-lg-4 col-md-5 col-sm-6 sm-mb-30">
					<div class="footer__two-widget pl-10">
						<h5>Contact Us</h5>
						<div class="footer__two-widget-contact">
							<div class="footer__two-widget-contact-item">
								<div class="footer__two-widget-contact-item-icon">
									<i class="fal fa-map-marker-alt"></i>
								</div>
								<div class="footer__two-widget-contact-item-content">
									<h6><a href="#">PV3M+X68 Welshpool United Kingdom</a></h6>
								</div>
							</div>
							<div class="footer__two-widget-contact-item">
								<div class="footer__two-widget-contact-item-icon">
									<i class="fal fa-phone-alt"></i>
								</div>
								<div class="footer__two-widget-contact-item-content">
									<h6><a href="tel:+125(895)658568">+125 (895) 658 568</a></h6>
								</div>
							</div>
							<div class="footer__two-widget-contact-item">
								<div class="footer__two-widget-contact-item-icon">
									<i class="fal fa-envelope-open-text"></i>
								</div>
								<div class="footer__two-widget-contact-item-content">
									<h6><a href="mailto:info.help@gmail.com">info.help@gmail.com</a></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-3 col-md-5 col-sm-6">
					<div class="footer__two-widget last">
						<h5>Follow Us</h5>
						<div class="footer__two-widget-follow">
                            <ul>
								<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a href="#"><i class="fab fa-snapchat"></i></a></li>
								<li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="copyright__two">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-xl-12">
						{{-- <div class="copyright__two-center">
							<p>Copyright © 2022<a href="index.html"> ThemeOri</a> Website by Barbex</p>
						</div> --}}
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer Two End -->	 
	<!-- Scroll Btn Start -->
	<div class="scroll-up">
		<svg class="scroll-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102"><path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" /> </svg>
	</div>
	<div class="modal fade" id="modal-data" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Trend Haircut</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
					<div class="row">
						<div class="col-xl-3 col-lg-6 col-md-6">
								<img class="img-fluid rounded" src="{{asset('images/services/1.jpg')}}" alt="">
						</div>
						<div class="col-xl-3 col-lg-6 col-md-6">
							<img class="img-fluid rounded" src="{{asset('images/services/2.jpg')}}" alt="">
						</div>
						<!--Tab slider End-->
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
							<h5>Short Hair And Long Hair</h5>
							<p> tetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
							<h5>Price Rp. 15000</h5>
							<a href="#for-booking"  class="theme-banner-btn bookmodal">Booking Now<i class="far fa-angle-double-right"></i></a>
						</div>
					</div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark light" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" id="save-btn" class="btn btn-primary">Save</button> --}}
                </div>
            </div>
        </div>
    </div>

	<!-- Scroll Btn End -->
	<!-- Main JS -->
<!-- jQuery -->
<!-- jQuery -->
<script src="{{ asset('template/landing/assets/js/jquery-3.6.0.min.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('template/landing/assets/js/bootstrap.min.js') }}"></script>
<!-- Counter up -->
<script src="{{ asset('template/landing/assets/js/jquery.counterup.min.js') }}"></script>
<!-- Popper JS -->
<script src="{{ asset('template/landing/assets/js/popper.min.js') }}"></script>
<!-- Magnific JS -->
<script src="{{ asset('template/landing/assets/js/jquery.magnific-popup.min.js') }}"></script>
<!-- Swiper JS -->
<script src="{{ asset('template/landing/assets/js/swiper-bundle.min.js') }}"></script>
<!-- Waypoints JS -->
<script src="{{ asset('template/landing/assets/js/jquery.waypoints.min.js') }}"></script>
<!-- Mean menu -->
<script src="{{ asset('template/landing/assets/js/jquery.meanmenu.min.js') }}"></script>
<!-- Custom JS -->
<script src="{{ asset('template/landing/assets/js/custom.js') }}"></script>

<script src="{{ asset('template/admin/vendor/select2/js/select2.full.min.js') }}"></script>

<script src="{{ asset('template/admin/vendor/global/global.min.js') }}"></script>
<script src="{{ asset('template/admin/vendor/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('template/admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('template/admin/vendor/apexchart/apexchart.js') }}"></script>
<script src="{{ asset('template/admin/vendor/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('template/admin/vendor/sweetalert2/dist/sweetalert2.min.js') }}" aria-hidden="true"></script>

<!-- Dashboard 1 -->
{{-- <script src="{{ asset('template/admin/js/dashboard/dashboard-2.js') }}"></script> --}}

<!-- tagify -->

<script src="{{ asset('template/admin/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/admin/vendor/datatables/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('template/admin/vendor/datatables/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('template/admin/vendor/datatables/js/jszip.min.js') }}"></script>
{{-- <script src="{{ asset('template/admin/js/plugins-init/datatables.init.js') }}"></script> --}}
<script src="{{ asset('template/admin/vendor/select2/js/select2.full.min.js') }}"></script>


<script src="{{ asset('template/admin/vendor/moment/moment.min.js') }}"></script>
<script src="{{ asset('template/admin/vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('template/admin/vendor/clockpicker/js/bootstrap-clockpicker.min.js') }}"></script>
<script src="{{ asset('template/admin/vendor/jquery-asColor/jquery-asColor.min.js') }}"></script>
<script src="{{ asset('template/admin/vendor/jquery-asGradient/jquery-asGradient.min.js') }}"></script>
<script src="{{ asset('template/admin/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js') }}"></script>
<script src="{{ asset('template/admin/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script src="{{ asset('template/admin/vendor/pickadate/picker.js') }}"></script>
<script src="{{ asset('template/admin/vendor/pickadate/picker.time.js') }}"></script>
<script src="{{ asset('template/admin/vendor/pickadate/picker.date.js') }}"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi peta
        latitude=-6.9175;
        longitude=107.6191;
        zoomLevel=13;
        var map = L.map('map').setView([latitude, longitude], zoomLevel); // Ganti latitude, longitude, dan zoomLevel sesuai kebutuhan
    
        // Tambahkan tile layer (misalnya OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 19
        }).addTo(map);
    
        // Tambahkan marker
        var marker = L.marker([latitude, longitude]).addTo(map); // Ganti latitude dan longitude sesuai lokasi marker
    
        // Tambahkan popup pada marker
        marker.bindPopup("<b>POINTCUT!</b>").openPopup(); // Ganti teks popup sesuai keinginan
    });
	
	$(".bookmodal").on("click", function (e) {$('#modal-data').modal("hide")})
	$(".services").on("click", function (e) {$('#modal-data').modal("show")})
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
<script src="{{ $javascriptFile }}"></script>


</body>

</html>