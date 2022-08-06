@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{url('home/index')}}">Home</a></li>
                <li class="active">Đặt hàng</li>
            </ol>
        </div>

        <div class="register-req">
            <p>Vui lòng Đăng ký và Thanh toán để dễ dàng truy cập vào lịch sử đơn đặt hàng của bạn </p>
        </div>
        <!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-15 clearfix">
                    <div class="bill-to">
                        <p>Hoá đơn</p>
                        <?php

                        use Illuminate\Support\Facades\Session;

                        $users = session::get('user');
                        ?>
                        <div class="form-one">
                            <form action="{{url('save_checkout')}}" method="post">
                                {{csrf_field()}}
                                <input type="text" name="email" placeholder="Email *" required
                                value="{{$users->email}}">
                                <input type="text" name="fullname" placeholder="Họ và Tên*" required
                                value="{{$users->fullname}}">
                                <input type="text" name="address" placeholder="Địa chỉ*" required
                                value="{{$users->address}}">
                                <input type="text" name="phone" placeholder="Số điện thoại *" required
                                value="{{$users->phone}}">
                                <textarea name="note" placeholder="Ghi chú" rows="16"></textarea>
                                <input type="submit" name="order" value="Gửi" class="btn btn-primary btn-sm">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#cart_items-->
@endsection