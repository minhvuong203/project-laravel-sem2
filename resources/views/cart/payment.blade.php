@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container" style="width:100%">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{url('home/index')}}">Home</a></li>
                <li class="active">Thanh toán</li>
            </ol>
        </div>
        <div class="review-payment">
            <h2>Giỏ hàng và thanh toán</h2>
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
                                    <input type="submit" value="update" name="update_qty" class="btn btn-default btn-sm" style="padding: 0.5rem 1rem">
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
        <h4 style="margin: 40px 0;font-size:20px">Chọn phương thức thanh toán</h4>
        <form action="{{url('payment_order')}}" method="post">
            {{csrf_field()}}
            <div class="payment-options">
                <span>
                    <label><input type="radio" name="payment_option" value="1"> Thanh toán qua thẻ</label>
                </span>
                <span>
                    <label><input type="radio" name="payment_option" value="2"> Thanh toán bằng tiền mặt</label>
                </span>
                <input type="submit" name="order" value="Thanh toán" class="btn btn-primary btn-sm">
            </div>
        </form>
    </div>
</section>
<!--/#cart_items-->
@endsection