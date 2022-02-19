@extends('admin.main')
@section('head')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
@endsection
@section('content')
    <form action="{{url('admin/menu/add')}}" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Tên Danh Mục</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Tên danh mục">
            </div>
            <div class="form-group">
                <label for="">Danh Mục</label>
                <select name="parent_id" id="" class="form-control">
                    <option value="0">Danh mục cha</option>
                    @foreach($menus as $menu)
                        <option value="{{$menu->id}}">{{$menu->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="description">Mô Tả</label>
                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="detail_desc">Mô Tả Chi Tiết</label>
                <textarea class="form-control" id="content" rows="3" name="detail_desc"></textarea>
            </div>
            <div class="form-group">
                <label for="">Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="active" name="active" value="1" checked>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="no_active" name="active" value="0">
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm danh mục</button>
        </div>
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection


