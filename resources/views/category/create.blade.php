@extends('layout.layout')
@section('title', 'create-new-category')
@section('content')

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thêm thể loại mới</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="{{ url('admin/category/createCategory') }}" onsubmit="return kiemtra()">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Tên thể loại</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter category name"
                                required>
                        </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Thêm</button>
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
    $(function () {
  bsCustomFileInput.init();
});
</script>
<script>
    function kiemtra(){
        let name = $("#name").val().trim();
        if (name == "") {
            alert('Tên không được để trống');
            $("#name").focus();
            return false;
        }
    }
</script>
@stop
