@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container" style="width:100%">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{url('home/index')}}">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <?php

                use Gloudemans\Shoppingcart\Facades\Cart;

                $content = Cart::content();
                ?>
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="prodcuct">Sản phẩm</td>
                        <td class="price">Giá tiền</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $values)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{url('images/'. $values->options->images)}}" alt="" width="100rem"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$values->name}}</a></h4>
                            <p>{{$values->category_name}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($values->price) .' '.'VND'}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{url('update_qty')}}" method="post">
                                    {{csrf_field()}}
                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{$values->qty}}" style="width: 3rem">
                                    <input type="hidden" value="{{$values->rowId}}" name="rowId_cart" class="form-control">
                                    <input type="submit" value="Chọn" name="update_qty" class="btn btn-default btn-sm" style="padding: 0.5rem 1rem">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                $total = $values->price * $values->qty;
                                echo number_format($total) . ' ' . 'VND';
                                ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{url('delete_cart/'. $values->rowId)}}" onclick="return xacnhan()"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<section id="do_action">
    <div class="container" style="width:100%">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-8">
                <div class="total_area">
                    <ul>
                        <li>Tiền hàng<span>{{Cart::pricetotal(0,',','.').' '.'VND'}}</span></li>
                        <li>Thuế <span>{{Cart::tax(0,',','.').' '.'VND'}}</span></li>
                        <li>Phí Ship <span>Free</span></li>
                        <li>Tổng tiền<span>{{Cart::total(0,',','.').' '.'VND'}}</span></li>
                    </ul>
                    @if(Session::get('user'))
                    <a class="btn btn-default check_out" href="{{url('checkout')}}">Đặt hàng</a>
                    @else
                    <a class="btn btn-default check_out" href="{{url('login')}}">Đặt hàng</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->
<script>
    function xacnhan() {
        return confirm('Bạn muốn xoá?');
    }
</script>
@endsection