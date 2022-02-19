@extends('admin.main')

@section('header')
@endsection

@section('content')
    <form action="{{url('admin/slider/edit/'.$slider->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tiêu đề</label>
                        <input type="text" name="name" value="{{$slider->name}}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="url">Đường dẫn</label>
                        <input type="text" name="url" value="{{$slider->url}}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="menu">Hình ảnh</label>
                <input type="file" name="file" class="form-control" id="upload">
            </div>

            <div>
                <img src="{{url($slider->thumb)}}" alt="" style="width: 200px;">
            </div>

            <div class="form-group">
                <label for="sort_by">Sắp xếp</label>
                <input type="number" name="sort_by" value="{{$slider->sort_by}}" class="form-control">
            </div>


            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active"
                           name="active" {{$slider->active == 1 ? 'checked': ''}}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active"
                           name="active" {{$slider->active == 0 ? 'checked': ''}}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Chỉnh sửa Slider</button>
        </div>
    </form>
@endsection

@section('footer')
@endsection
