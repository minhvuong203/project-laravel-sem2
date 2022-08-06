@extends('layout.layout')
@section('title', 'view-product')
@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Xem sản phẩm {{$p->product_name}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Mã sản phẩm</label>
                        <input type="text" class="form-control" name="id" id="id" value="{{$p->product_id}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Tên thể loại</label>
                        <input type="text" class="form-control" name="category_name" id="category_name" value="{{$p->category_name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$p->product_name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Giá</label>
                        <input type="number" class="form-control" name="price" id="price" value="{{$p->product_price}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea name="description" id="description" cols="10" rows="5"  class="form-control" value="{{$p->product_des}}" readonly>{{$p->product_des}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Nội dung</label>
                        <textarea name="content" id="content" cols="30" rows="10"  class="form-control" value="{{$p->product_content}}" readonly>{{$p->product_content}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Hình ảnh</label>
                        <img src="{{asset('images/' .$p->product_images)}}" alt="{{$p->product_id}}" class="img-fluid" readonly>
                        <!-- <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div> -->
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