@extends('admin.main')

@section('header')
@endsection

@section('content')
    <form action="{{url('admin/slider/add')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tiêu đề</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="url">Đường dẫn</label>
                        <input type="text" name="url" value="{{old('url')}}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="menu">Hình ảnh</label>
                <input type="file" name="file" class="form-control" id="upload">
            </div>

            <div class="form-group">
                <label for="sort_by">Sắp xếp</label>
                <input type="number" name="sort_by" value="1" class="form-control">
            </div>

            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active">
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm Slider</button>
        </div>
    </form>
@endsection

@section('footer')
@endsection
