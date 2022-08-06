<!-- dua cac resource vao trang -->
@extends('layout.layout')
@section('title','admin')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách người dùng</h3>
                </div>
                <div class="card-header">
                    <a href="{{url('admin/displayAddUser')}}">
                        <h4>Tạo người dùng mới</h4>
                    </a>
                </div>
                <form action="{{url('users')}}" method="Post">
                    {{ csrf_field() }}
                    <div style="padding: 1rem">
                        <label for="">Tìm kiếm</label>
                        <input type="text" name="search" id="search" placeholder="Nhập nội dung tìm kiếm">
                    </div>
                </form>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="product" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Mã người dùng</th>
                                <th>Họ và Tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Mật khẩu</th>
                                <th>Vai trò</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->users_id }}</td>
                                <td>{{ $user->fullname}}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->password}}</td>
                                <td>{{ $user->role == 1 ? 'Admin' : 'Customers'}}</td>
                                <td class="text-right">
                                    <a class="btn btn-primary btn-sm" href="{{ url('admin/view/'.$user->users_id) }}">
                                        <i class="fas fa-folder"></i> Xem
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ url('admin/update/'.$user->users_id) }}">
                                        <i class="fas fa-pencil-alt"></i> Sửa
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="{{ url('admin/delete/'.$user->users_id) }}" onclick="return xacnhan()">
                                        <i class="fas fa-trash"></i> Xoá
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Mã người dùng</th>
                                <th>Họ và Tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Mật khẩu</th>
                                <th>Vai trò</th>
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
    };
</script>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: "{{ URL::to('user') }}",
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