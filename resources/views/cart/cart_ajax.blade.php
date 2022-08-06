@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
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
                        <td class="image">Images</td>
                        <td class="description">Item</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
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
                            <h4><a href=""></a></h4>
                            <p></p>
                        </td>
                        <td class="cart_price">
                            <p></p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{url('update_qty')}}" method="post">
                                    {{csrf_field()}}
                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{$values->qty}}">
                                    <input type="hidden" value="{{$values->rowId}}" name="rowId_cart" class="form-control">
                                    <input type="submit" value="update" name="update_qty" class="btn btn-default btn-sm">
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
                            <a class="cart_quantity_delete" href="#" onclick="return xacnhan()"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span></span></li>
                        <li>Eco Tax <span></span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span></span></li>
                    </ul>
                    <a class="btn btn-default check_out" href="{{url('login')}}">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->


<script>
    function xacnhan() {
        return confirm('Are you sure');
    }
</script>
@endsection