<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Sing In</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{asset('form/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('form/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{asset('form/css/material-dashboard.css?v=3.0.4')}}" rel="stylesheet" />
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
</head>

<body class="bg-gray-200">
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-5 col-md-7 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-4 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Đăng ký</h4>
                                </div>
                            </div>
                            <div class="container">
                                <form action="{{url('addCustomers')}}" method="POST" onsubmit="return kiemtra()">
                                    @csrf
                                    <!-- form su dung method post bat buoc phai co @csrf -->
                                    <div class="input-group input-group-outline mb-3"><br>
                                        <input type="email" class="form-control" name="email" id="email" required placeholder="Enter Email">
                                        <span style="color: red;" id="show"></span>
                                    </div>
                                    <div class="input-group input-group-outline mb-3"><br>
                                        <input type="text" class="form-control" name="fullname" id="fullname" required placeholder="Enter Fullname">
                                    </div>
                                    <div class="input-group input-group-outline mb-3"><br>
                                        <input type="phone" class="form-control" name="phone" id="phone" required placeholder="Enter phone">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="password" class="form-control" name="password" id="password" required placeholder="Enter Password">
                                    </div>
                                    <div class="input-group input-group-outline mb-3"><br>
                                        <input type="password" class="form-control" name="pwd" id="pwd" required placeholder="Enter Password-Confirm">
                                    </div>                              
                                    <div class="input-group input-group-outline mb-3"><br>
                                        <input type="text" class="form-control" name="address" id="address" required placeholder="Enter Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Gender</label><br>
                                        <select name="gender" id="gender" required>
                                            <option value="1">Nam</option>
                                            <option value="2">Nữ</option>
                                        </select>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Đăng ký</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="{{('form/js/core/popper.min.js')}}"></script>
    <script src="{{('form/js/core/bootstrap.min.js')}}"></script>
    <script src="{{('form/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{('form/js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{('form/js/material-dashboard.min.js?v=3.0.4')}}"></script>
    <script>
        $(function() {
            $('#email').on('keyup', function() {
                let mail = $(this).val();
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
</body>

</html>