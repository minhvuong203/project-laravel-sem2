<!-- dua cac resource vao trang -->
@extends('layout.layout')
@section('title','products')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liệt Kê Đơn Hàng</h3>
                </div>
                <form action="{{url('index')}}" method="Post">
                    {{ csrf_field() }}
                    <div>
                        <label for="">Tìm Kiếm</label>
                        <input type="text" name="search" id="search" placeholder="Enter Search">
                    </div>
                </form>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="product" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Mã don hang</th>
                                <th>Tên người đặt</th>
                                <th>Tổng Giá Tiền</th>
                                <th>Tình Trạng</th>
                                <th>Hiển Thị</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_order as $order)
                            <tr>
                                <td>{{ $order->order_id }}</td>
                                <td>{{ $order->fullname }}</td>
                                <td>{{ $order->order_total}}</td>
                                <td>{{ $order->order_status }}</td>
                                <td class="text-right">
                                    <a class="btn btn-primary btn-sm" href="{{ url('admin/order/view/'.$order->order_id) }}">
                                        <i class="fas fa-folder"></i> Xem
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ url('admin/order/update/'.$order->order_id) }}">
                                        <i class="fas fa-pencil-alt"></i> Sửa
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="{{ url('admin/order/delete/'.$order->order_id) }}" onclick="return xacnhan()">
                                        <i class="fas fa-trash"></i> Xoá
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Mã don hang</th>
                                <th>Tên người đặt</th>
                                <th>Tổng Giá Tiền</th>
                                <th>Tình Trạng</th>
                                <th>Hiển Thị</th>
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