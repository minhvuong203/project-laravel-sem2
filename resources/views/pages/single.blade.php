@extends('layout')
@section('content')
@foreach($details_product as $details)
<div class="container" style="width:100%">
    <div class="row" >
        <div class="col-lg-7" style="padding-right: 5rem;">
            <div class="single_product_pics">
                <div class="row">
                    <div class>
                        <div class="single_product_thumbnails">
                            <ul>
                                <li><img style="width:100%" src="{{url('images/'. $details->product_images)}}" alt="" />
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="product_details">
                <form action="{{url('show_cart')}}" method="post">
                    {{csrf_field()}}
                    <div class="product_details_title">
                        <h2 class="product_name">{{$details->product_name}}</h2>
                        <p class="product_des">{{$details->product_des}}</p>
                        <div class="product_price" style="padding-bottom: 2rem;">{{number_format($details->product_price).' '.'VND'}}</div>
                    </div>
                    <div class="free_delivery d-flex flex-row align-items-center justify-content-center">
                        <pre>{{$details->product_content}}</pre>
                    </div>
                    <div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
                        <div class="quantity_selector">
                            <label for="">Quantity</label>
                            <input name="quantity" type="number" value="1" min="1"  style="width: 5rem">
                            <input type="hidden" name="product_id" value="{{$details->product_id}}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart"></i>
                        Thêm vào giỏ hàng
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection