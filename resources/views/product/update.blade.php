@extends('layout.layout')
@section('title', 'update-product')
@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Sửa sản phẩm {{$p->product_name}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/product/updatePost/'.$p->product_id)}}" onsubmit="return kiemtra()">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Mã sản phẩm</label>
                        <input type="text" class="form-control" name="id" id="id" value="{{$p->product_id}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Thể loại </label>
                        <select name="product_cate" id="product_cate">
                            @foreach($category_product as $category)
                            <option value="{{$category->category_id}}" 
                            @if($category->category_id == $p->category_id) selected @endif>
                                {{$category->category_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$p->product_name}}">
                    </div>
                    <div class="form-group">
                        <label for="">Giá</label>
                        <input type="number" class="form-control" name="price" id="price" value="{{$p->product_price}}">
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea name="description" id="description" cols="10" rows="5" placeholder="Enter content" class="form-control" value="{{$p->product_des}}">{{$p->product_des}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Nội dung</label>
                        <textarea name="content" id="content" cols="30" rows="10" placeholder="Enter content" class="form-control" value="{{$p->product_content}}">{{$p->product_content}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Hình ảnh</label>
                        <img src="{{asset('images/' .$p->product_images)}}" alt="{{$p->product_id}}" class="img-fluid">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="fileImage" name="fileImage">
                                <label class="custom-file-label" for="">Chọn file</label>
                            </div>
                            <!-- <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div> -->
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Sửa</button>
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
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
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