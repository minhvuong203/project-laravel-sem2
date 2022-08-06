@extends('layout')
@section('title', 'Home')
@section('content')
<div>
	<!--features_items-->
	<h2 class="title text-center">Tìm kiếm</h2>
	@foreach($search_product as $product)
	<div class="col-sm-4">
		<div class="product-image-wrapper">
			<div class="single-products">
				<div class="productinfo text-center">
					<img src="{{url('images/'. $product->product_images)}}" alt="" />
					<h2> <a href="{{url('/single/'.$product->product_id)}}">
							{{$product->product_name}}</h2>
					<p>{{number_format($product->product_price).' '.'VND'}}</p>
					<a href="{{url('/single/'.$product->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Xem chi tiết</a>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div>
@endsection