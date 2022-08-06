@extends('layout.layout')
@section('title', 'view-category')
@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Xem thể loại {{$p->category_id}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Mã thể loại</label>
                        <input type="text" class="form-control" name="id" id="id" value="{{$p->category_id}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Tên thể loại</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$p->category_name}}"readonly>
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