@extends('layout')
@section('title', 'Home')
@section('content')
<div class="content">
	<!--features_items-->
	<h2 class="title text-center">Danh sách sản phẩm</h2>
	@foreach($show_category as $show)
	<div class="col-sm-4">
		<div class="product-image-wrapper">
			<div class="single-products">
				<div class="productinfo text-center">
					<img src="{{url('images/'. $show->product_images)}}" alt="" />
					<h2> <a href="{{url('/single/'.$show->product_id)}}">
							{{$show->product_name}}</h2>
					<p>{{number_format($show->product_price).' '.'VND'}}</p>
					<a href="{{url('/single/'.$show->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Xem chi tiết</a>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div>
<!--/product-details-->

@endsection