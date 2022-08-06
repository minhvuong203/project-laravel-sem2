<!-- dua cac resource vao trang -->
@extends('layout.layout')
@section('title','index-products')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách sẩn phẩm</h3>
                </div>
                <form action="{{url('index')}}" method="Post">
                    {{ csrf_field() }}
                    <div style="padding: 1rem;">
                        <label for="">Tìm kiếm</label>
                        <input type="text" name="search" id="search" placeholder="Enter Search">
                    </div>
                </form>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="product" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Mã sản phẩm</th>
                                <th>Thể loại </th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Hình ảnh</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $p)
                            <tr>
                                <td>{{ $p->product_id }}</td>
                                <td>{{ $p->category_name}}</td>
                                <td>{{ $p->product_name }}</td>
                                <td>{{ $p->product_price }}</td>
                                <td><img width="100px" src="{{ url('images/'.$p->product_images) }}" /></td>
                                <td class="text-right">
                                    <a class="btn btn-primary btn-sm" href="{{ url('admin/product/view/'.$p->product_id) }}">
                                        <i class="fas fa-folder"></i> Xem
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ url('admin/product/update/'.$p->product_id) }}">
                                        <i class="fas fa-pencil-alt"></i> Sửa
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="{{ url('admin/product/delete/'.$p->product_id) }}" onclick="return xacnhan()">
                                        <i class="fas fa-trash"></i> Xoá
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Mã sản phẩm</th>
                                <th>Thể loại </th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Hình ảnh</th>
                                <th>Hành động</th>
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
        return confirm('Bạn muốn xoá ?');
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