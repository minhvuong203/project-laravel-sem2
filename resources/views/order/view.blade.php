<!-- dua cac resource vao trang -->
@extends('layout.layout')
@section('title','view-order')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Thông tin người đặt hàng</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tên người mua</th>
                                <th>Số điện thoại</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $order_byid->customer->fullname }}</td>
                                <td>{{ $order_byid->customer->phone}}</td>
                                <td style="text-align: right;">{{$order_byid->order_total}}</td>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Thông tin vận chuyển </h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tên người nhận</th>
                                <th>Địa chỉ giao hàng</th>
                                <th>Số điện thoại</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $order_byid->receiver->fullname }}</td>
                                <td>{{ $order_byid->receiver->address }}</td>
                                <td>{{ $order_byid->receiver->phone}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liệt kê chi tiết đơn hàng</h3>
                </div>
                <!-- <form action="{{url('index')}}" method="Post">
                    {{ csrf_field() }}
                    <div>
                        <label for="">Search</label>
                        <input type="text" name="search" id="search" placeholder="Enter Search">
                    </div>
                </form> -->
                <!-- /.card-header -->
                <div class="card-body">
                    <table  class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order_byid->order_items as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->product_qty}}</td>
                                <td style="text-align: right;">{{number_format($item->product_price) .' '.'VND'}}</td>
                                <td style="text-align: right;">{{number_format($item->product_qty * $item->product_price).' '.'VND'}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

@stop
@section('script-section')
<script>
    $(function() {
        $('#product').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });

    function xacnhan() {
        return confirm('Are you sure');
    }
</script>

<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: "{{ URL::to('index') }}",
                data: {
                    'search': $value
                },
                success: function(data) {
                    $('tbody').html(data);
                }
            });
        })
    });
</script>
@endsection