@extends('layout.layout')
@section('title', 'create-new-slider')
@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Thêm Silder mới</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/slider/create_slider') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Tên Silder</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter product name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <input type="text" class="form-control" name="description" id="description" placeholder="Enter product description" required>
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

@stop