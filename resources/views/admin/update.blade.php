@extends('layout.layout')
@section('title', 'Update-Users')
@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Sửa {{$ds->fullname}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/updatePost/'.$ds->users_id)}}" onsubmit="return kiemtra()">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Mã người dùng</label>
                        <input type="text" class="form-control" name="id" id="id" value="{{$ds->users_id}}">
                    </div>
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input type="text" class="form-control" name="fullname" id="fullname" value="{{$ds->fullname}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{$ds->email}}" required>
                        <span style="color: red;" id="show"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input type="number" class="form-control" name="phone" id="phone" value="{{$ds->phone}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Mật khẩu</label>
                        <input type="password" class="form-control" name="password" id="password" value="{{$ds->password}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" name="pwd" id="pwd" value="{{$ds->password_confirm}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Giới tính</label><br>
                        <select name="gender" required>
                            <option value="1" @if($ds->gender == 1) selected @endif >Male</option>
                            <option value="2" @if($ds->gender == 2) selected @endif >Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" class="form-control" name="address" id="address" value="{{$ds->address}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Vai trò</label><br>
                        <select name="role" required>
                            <option value="1" @if($ds->role ==1 ) selected @endif >Admin</option>
                            <option value="2" @if($ds->role ==2 ) selected @endif >Customers</option>
                        </select>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Gửi</button>
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
<script>
    $(function() {
        $('#email').on('keyup', function() {
            let mail = $(this).val();
            console.log(mail);
            if (mail == '') {
                $("#show").html('');
            } else if (mail != '') {
                $.ajax({
                    type: 'get',
                    url: '{{url('testEmail')}}',
                    data: {
                        'email': mail
                    },
                    success: function(data) {
                        $("#show").html(data);
                    }
                });
            }
        })
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    });
</script>
<script>
    //day la ma kich ban javascript kiem tra du lieu cua form truoc khi day len sever
    function kiemtra() {
        //Kiem tra fullname
        let fullname = $("#fullname").val().trim();
        if (fullname == "") {
            alert('Tên không được để trống');
            $("#fullname").focus();
            return false;
        }
        //Kiem tra phone
        let tel = /((09|03|07|08|05)+([0-9]{8})\b)/;
        let phone = $("#phone").val().trim();
        if (phone != '') {
            if (tel.test(phone) == false) {
                alert('Số điện thoại không hợp lệ !');
                $("#phone").focus();
                return false;
            }
        } else {
            alert('Vui lòng điền số điện thoại'); 
            return false;    
        }
        //Kiem tra password
        let pass = $("#password").val().trim();
        if (pass.length == 0) {
            $("#password").focus();
            alert("Mật khẩu không được để trống !");
            return false;
        }

        //Kiem tra password-cofirm
        let pass2 = $("#pwd").val().trim();
        if (pass2.length == 0) {
            $("#pwd").focus();
            alert("Nhập lại mật khẩu không được để trống!");
            return false;
        }
        //Kiem tra password-cofirm
        let address = $("#address").val().trim();
        if (address.length == 0) {
            $("#address").focus();
            alert("Địa chỉ không được để trống !");
            return false;
        }

        //Kiem tra password confirm voi password
        if (pass2 !== pass) {
            $("#pwd").focus();
            alert("Mật khẩu không trùng khớp!");
            return false;
        }
    }
</script>
@stop