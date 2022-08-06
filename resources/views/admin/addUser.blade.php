@extends('layout.layout')
@section('title', 'create-new-Admin')
@section('content')
<style>
    .required {
        color: red;
        font-weight: bolder;
    }

    label {
        color: blue;
        display: inline-block;
        width: 200px;
    }

    #message {
        color: red;
    }
</style>
<div>
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tạo Admin mới</h3>
            </div>
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/addUser') }}" onsubmit="return kiemtra()">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Enter Fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                        <span style="color: red;" id="show"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone">
                    </div>
                    <div class="form-group">
                        <label for="">Mật Khẩu</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Enter Password Confirm" required>
                    </div>
                    <div class="form-group">
                        <label for="">Giới tính</label><br>
                        <select name="gender" required>
                            <option value="1">Nam</option>
                            <option value="2">Nữ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" required>
                    </div>
                    <div class="form-group">
                        <label for="">Vai trò</label><br>
                        <select name="role" required>
                            <option value="1">Admin</option>
                            <option value="2">Customers</option>
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Đăng kí</button>
                </div>
                <div>
                    @if (session('Error'))
                    <h6 style="color: red">
                        Errors: {{ session('Error') }}
                    </h6>
                    @endif
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@section('script-section')
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
        let tel= /((09|03|07|08|05)+([0-9]{8})\b)/; 
        let phone=$("#phone").val().trim();
        if(phone!= ''){
            if(tel.test(phone) == false){
                alert('Số điện thoại không hợp lệ !');
                return false;
            }
        }else{
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