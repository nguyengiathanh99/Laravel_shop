@extends('admin.main')
@section('content')
    @if(!empty($products))
        <table class="table">
            <thead>
            <tr>
                <th style="width: 50px">#</th>
                <th>Tên sản phẩm</th>
                <th style="width: 100px">Ảnh</th>
                <th>Danh mục</th>
                <th>Giá gốc</th>
                <th>Giảm giá</th>
                <th>Hoạt động</th>
                <th>Upadate_at</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @php($t=0)
            @foreach($products as $product)
                @php($t++)
                <tr>
                    <td>{{$t}}</td>
                    <td>{{$product->name}}</td>
                    <td><img width="100px" src="{{url($product->thumb)}}" alt=""></td>
                    <td>{{$product->menu->name}}</td>
                    <td>{{number_format($product->price,0,'','.')}}đ</td>
                    <td>{{number_format($product->price_sale,0,'','.')}}đ</td>
                    <td>{!! \App\Helpers\Helper::active('$product->active') !!}</td>
                    <td>{{$product->updated_at}}</td>
                    <td>
                        <a href="{{route('admin.product.edit',$product->id)}}" class="btn btn-success btn-sm"><i
                                class="fas fa-edit"></i></a>
                        {{--                        <a href= "{{route('admin.product.delete',$product->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>--}}
                        <a href="{{url('admin/product/delete/'.$product->id)}}" class="btn btn-danger btn-sm"><i
                                class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="card-footer clearfix">
            {{$products->links()}}
        </div>
    @endif
@endsection


