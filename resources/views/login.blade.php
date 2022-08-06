<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>login</title>
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
</head>

<body class="bg-gray-200">
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Đăng nhập</h4>
                                    <div class="row mt-3">
                                        <div class="col-2 text-center ms-auto">
                                            <a class="btn btn-link px-3" href="{{url('login_facebook')}}">
                                                <i class="fa fa-facebook text-white text-lg"></i>
                                            </a>
                                        </div>
                                        <div class="col-2 text-center me-auto">
                                            <a class="btn btn-link px-3" href="javascript:;">
                                                <i class="fa fa-google text-white text-lg"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="container">
                                <!-- message duoc lay tu key ben trang AcountController  -->
                                @if (session('message'))
                                <h4 style="color: red">
                                    Error: {{ session('message') }}
                                </h4>
                                @endif
                                <form action="{{url('checkLogin')}}" method="POST">
                                    @csrf
                                    <!-- form su dung method post bat buoc phai co @csrf -->
                                    <div class="input-group input-group-outline my-3">
                                        <!-- <label class="form-label"></label> -->
                                        <input type="email" class="form-control" name="email" required placeholder="Enter Email">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <!-- <label class="form-label">Password</label> -->
                                        <input type="password" class="form-control" name="password" required placeholder="Enter Password">
                                    </div>
                                    <div class="form-check form-switch d-flex align-items-center mb-3">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                                        <label class="form-check-label mb-0 ms-3" for="rememberMe">Nhớ mật khẩu</label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Đăng nhập</button>
                                    </div>
                                    <p class="mt-4 text-sm text-center">
                                        <b> Tạo tài khoản mới !</b>                                     
                                        <a href="{{url('addCustomer')}}" class="text-primary text-gradient font-weight-bold">Đăng ký</a>
                                    </p>
                                    <p class="mt-4 text-sm text-center">
                                        <b>Quên mật khẩu ?</b>                                      
                                        <a href="#" class="text-primary text-gradient font-weight-bold">Quên mật khẩu</a>
                                    </p>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="{{asset('form/js/core/popper.min.js')}}"></script>
    <script src="{{asset('form/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('form/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('form/js/plugins/smooth-scrollbar.min.js')}}"></script>
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
    <script src="{{asset('form/js/material-dashboard.min.js?v=3.0.4')}}"></script>
</body>

</html>