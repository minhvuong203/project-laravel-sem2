<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Shop Flower</title>
	<link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/sweetalert.css')}}" rel="stylesheet">
	<link rel="shortcut icon" href="images/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/ico/apple-touch-icon-114-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/ico/apple-touch-icon-72-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" href="{{asset('images/ico/apple-touch-icon-57-precomposed.png')}}">
</head>
<!--/head-->

<body>
	<header id="header">
		<div class="header-middle">
			<!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="{{url('home/index')}}">
								<img src="{{asset('../public/images/logo.jpg')}}" alt="" style="width: 30%;" />
							</a>
						</div>
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav " style="padding: 2rem;">
								<li><a href="{{url('login')}}"><i class="fa fa-user"></i> Tài khoản</a></li>
								<li><a href="#"><i class="fa fa-star"></i> Danh sách yêu thích</a></li>
								<li><a href="{{url('show_cart')}}"><i class="fa fa-lock"></i>Giỏ hàng</a></li>
								<li><a href="{{url('contact')}}"><i class="fa fa-file"></i>Liên hệ</a></li>
								@if (Session::get('user'))
								<li><a href="{{url('logout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
								@else
								<li><a href="{{url('login')}}"><i class="fa fa-lock"></i> Đăng Nhập</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/header-middle-->
		<div class="header-middle">
			<div class="container">
				<form action="{{url('search_product')}}" method="post">
					{{csrf_field()}}
					<div class="search_box pull-right">
						<input type="text" name="search" placeholder="Nhập nội dung" />
						<input type="submit" name="search_item" value="Search" class="bt btn-success btn-sm " />
					</div>
				</form>
			</div>
		</div>
	</header>
	<!--/header-->
	<section id="slider">
		<!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>					
						<div class="carousel-inner">
							@php
							$i= 0;
							@endphp
							@foreach ($slider as $slide)
							@php
							$i++;
							@endphp
							<div class="item {{$i==1 ? 'active':''}}">
								<div class="col-sm-12">
									<img style="width:100%" src="{{url('images/'. $slide->slider_images)}}" alt="" class="img img-responsive" />
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/slider-->

	<section>
		<div class="container" style="width:90%">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Thể loại sản phẩm</h2>
						<div class="panel-group category-products" id="accordian">
							<!--category-productsr-->
							@foreach($category as $ds)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<li class="grid_button ustify-content-center">
											<a href="{{url('/show_category/'. $ds->category_id)}}">{{$ds->category_name}}</a>
										</li>
									</h4>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
				<div class="col-sm-9 padding-right">
					@yield('content')
				</div>
			</div>

		</div>
	</section>

	<footer id="footer">

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2022 Shop Flower Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span>Group 1</span></p>
				</div>
			</div>
		</div>

	</footer>
	<!--/Footer-->



	<script src="{{asset('frontend/js/jquery.js')}}"></script>
	<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('frontend/js/price-range.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
	<script src="{{asset('frontend/js/main.js')}}"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>