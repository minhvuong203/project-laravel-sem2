<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">
        <!-- ham asset de bat link trong thu muc public -->
        <img src="{{asset('../public/images/logo.jpg')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Shop Flowers</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">
                    <?php
                    use Illuminate\Support\Facades\Session;
                    $name = session::get('user');
                    if($name){
                        echo ($name->fullname);
                    }
                    ?>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Trang người dùng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/users') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Xem danh sách </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/displayAddUser') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tạo người dùng mới</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Trang sản phẩm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/product/index') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Xem danh sách</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/product/create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tạo sản phẩm mới</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Trang thể loại
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/category/index') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Xem danh sách</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/category/create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tạo thể loại mới</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Trang đơn hàng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/order/index') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản lý đơn hàng</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Trang vận chuyển
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/delivery') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản lý vận chuyển</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Trang Slider
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/manager_slider') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản lý Slider</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>