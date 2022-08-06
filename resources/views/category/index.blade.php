<!-- dua cac resource vao trang -->
@extends('layout.layout')
@section('title','category')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="color: blue;">Danh sách thể loại sản phẩm</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="product" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Mã thể loại</th>
                                <th>Tên thể loại</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category as $p)
                            <tr>
                                <td>{{ $p->category_id }}</td>
                                <td>{{ $p->category_name }}</td>
                                <td class="text-right">
                                    <a class="btn btn-primary btn-sm" href="{{ url('admin/category/view/'.$p->category_id) }}">
                                        <i class="fas fa-folder"></i> Xem
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ url('admin/category/update/'.$p->category_id) }}">
                                        <i class="fas fa-pencil-alt"></i> Sửa
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="{{ url('admin/category/delete/'.$p->category_id) }}" onclick="return xacnhan()">
                                        <i class="fas fa-trash"></i> Xoá
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Mã thể loại</th>
                                <th>Tên thể loại</th>
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

@endsection