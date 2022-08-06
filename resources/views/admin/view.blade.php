@extends('layout.layout')
@section('title', 'view-Users')
@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Xem {{$ds->fullname}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Mã người dùng</label>
                        <input type="text" class="form-control" name="id" id="id" value="{{$ds->users_id}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Họ và Tên</label>
                        <input type="text" class="form-control" name="fullname" id="fullname" value="{{$ds->fullname}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="{{$ds->email}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input type="number" class="form-control" name="phone" id="phone" value="{{$ds->phone}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Mật khẩu</label>
                        <input type="password" class="form-control" name="password" id="password" value="{{$ds->password}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" name="pwd" id="pwd" value="{{$ds->password_confirm}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Giới tính</label>
                        <input type="text" class="form-control" name="gender" id="gender" value="{{$ds->gender == 1 ? 'Male' : 'Female'}}" readonly>
                    </div>                 
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" class="form-control" name="gender" id="gender" value="{{$ds->address}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Vai trò</label>
                        <input type="text" class="form-control" name="roe" id="role" value="{{$ds->role == 1 ? 'Admin' : 'Customers'}}" readonly>
                    </div>
                    
                </div>
        </div>
        </form>
    </div>
    <!-- /.card -->


</div>
</div>

@endsection

@section('script-section')
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>
@stop