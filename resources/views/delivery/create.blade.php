@extends('layout.layout')
@section('title', 'tinh-phi-van-chuyen')
@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Thêm vận chuyển</h3>
            </div>
            <form enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Chọn thành phố</label>
                        <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                            <option value="">--Chọn tỉnh thành phố--</option>
                            @foreach($city as $thanhpho)
                            <option value="{{$thanhpho->matp}}">{{$thanhpho->name_city}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Chọn quận huyện</label>
                        <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                            <option value="">--Chọn quận huyện--</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Chọn xã phường</label>
                        <select name="wards" id="wards" class="form-control input-sm m-bot15  wards">
                            <option value="">--Chọn xã phường--</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Phí vận chuyển</label>
                        <input type="text" name="fee_ship" class="form-control fee_ship">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" name="add_delivery" class="btn btn-primary add_delivery">Thêm phí vận chuyển</button>
                </div>
            </form>
        </div>
        <div id="load-delivery">
            
        </div>
    </div>
</div>
@endsection
@section('script-section')
@stop