<!-- dua cac resource vao trang -->
@extends('layout.layout')
@section('title','index-slider')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách slider</h3>
                </div>
                <div class="card-header">
                    <a href="{{url('admin/slider/create')}}">
                        <h4>Tạo Slider mới</h4>
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="product" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Mã slider</th>
                                <th>Hình ảnh</th>
                                <th>Tên Slider</th>
                                <th>Mô tả</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_slider as $slider)
                            <tr>
                                <td>{{ $slider->slider_id }}</td>
                                <td><img width="100px" src="{{ url('images/'.$slider->slider_images) }}" /></td>
                                <td>{{ $slider->slider_name}}</td>
                                <td>{{ $slider->slider_des}}</td>
                                <td class="text-right">
                                    <a class="btn btn-danger btn-sm" href="{{ url('admin/slider/delete/'.$slider->slider_id) }}" onclick="return xacnhan()">
                                        <i class="fas fa-trash"></i> Xoá
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Mã slider</th>
                                <th>Hình ảnh</th>
                                <th>Tên Slider</th>
                                <th>Mô tả</th>
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
        return confirm('Ban chac xoa');
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