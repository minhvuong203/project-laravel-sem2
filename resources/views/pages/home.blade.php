@extends('layout')
@section('title', 'Home')
@section('content')
<div>
	<h2 class="title text-center">Danh sách sản phẩm</h2>
	@foreach($all_product as $product)
	<div class="col-sm-4">
		<div class="product-image-wrapper">
			<div class="single-products">
				<form>
					@csrf
					<input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
					<input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
					<input type="hidden" value="{{$product->product_images}}" class="cart_product_images_{{$product->product_id}}">
					<input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
					<input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

					<div class="productinfo text-center">
						<img src="{{url('images/'. $product->product_images)}}" alt="" />
						<h2> <a href="{{url('/single/'.$product->product_id)}}">
								{{$product->product_name}}</h2>
						<p>{{number_format($product->product_price).' '.'VND'}}</p> </a>
					</div>
					<div class="productinfo text-center">
						<button class="btn btn-default add-to-cart" name="add_to_cart"> 
							<a href="{{url('/single/'.$product->product_id)}}">Xem chi tiết đơn hàng</a>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	@endforeach
</div>
@endsection