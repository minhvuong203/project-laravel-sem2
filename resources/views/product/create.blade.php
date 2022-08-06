@extends('layout.layout')
@section('title', 'create-new-product')
@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Thêm sản phẩm mới</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/product/createPost') }} " onsubmit="return kiemtra()">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Thể loại </label>
                        <select name="product_cate" id="product_cate">
                            @foreach($category_product as $category)
                            <option value="{{$category->category_id}}">
                                {{$category->category_name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter product name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Giá</label>
                        <input type="number" class="form-control" name="price" id="price" placeholder="Enter product price" required min="1" max="15000000">
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <input type="text" class="form-control" name="description" id="description" placeholder="Enter product description" required>
                        <!-- <textarea name="description" id="description" cols="20" rows="10" placeholder="Enter product description" class="form-control" required></textarea> -->
                    </div>
                    <div class="form-group">
                        <label for="">Nội dung</label>
                        <textarea name="content" id="content" cols="30" rows="10" placeholder="Enter content" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Chọn hình ảnh</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="fileImage" name="fileImage">
                                <label class="custom-file-label" for="">Chọn file</label>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
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
        <!-- /.card -->


    </div>
</div>

@endsection

@section('script-section')
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>
<script>
    //day la ma kich ban javascript kiem tra du lieu cua form truoc khi day len sever
    function kiemtra() {
    
        let name = $("#name").val().trim();
        if (name == "") {
            alert('Tên không được để trống');
            $("#name").focus();
            return false;
        }
    
        let price = $("#price").val().trim();
        if (price.length == 0) {
            $("#price").focus();
            alert("Giá không được để trống !");
            return false;
        }


        let des = $("#description").val().trim();
        if (des.length == 0) {
            $("#description").focus();
            alert("Mô tả không được để trống !");
            return false;
        }

        let content = $("#content").val().trim();
        if (content.length == 0) {
            $("#content").focus();
            alert("Nội dung không được để trống !");
            return false;
        }
        let file = $("#fileImage").val().trim();
        if (file.length == 0) {
            $("#fileImage").focus();
            alert("Hình ảnh không được để trống !");
            return false;
        }
    }
</script>
@stop