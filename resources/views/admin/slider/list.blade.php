@extends('admin.main')
@section('content')
    @if(!empty($sliders))
        <table class="table">
            <thead>
            <tr>
                <th style="width: 50px">#</th>
                <th>Tiêu đề</th>
                <th style="width: 100px">Ảnh</th>
                <th style="text-align: center">Sắp xếp</th>
                <th>Trạng thái</th>
                <th>Upadate_at</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @php($t=0)
            @foreach($sliders as $slider)
                @php($t++)
                <tr>
                    <td>{{$t}}</td>
                    <td>{{$slider->name}}</td>
                    <td>
                        <a href="{{url($slider->thumb)}}">
                            <img width="100px" src="{{url($slider->thumb)}}" alt="">
                        </a>
                    </td>
                    <td style="text-align: center">{{$slider->sort_by}}</td>
                    <td>{!! \App\Helpers\Helper::active('$slider->active') !!}</td>
                    <td>{{$slider->updated_at}}</td>
                    <td>
                        <a href= "{{url('admin/slider/edit/'.$slider->id)}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                        <a href= "{{url('admin/slider/delete/'.$slider->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$sliders->links()}}
    @endif
@endsection


