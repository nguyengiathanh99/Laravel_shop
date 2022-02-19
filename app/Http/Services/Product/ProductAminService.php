<?php

namespace App\Http\Services\Product;

use App\Helpers\Helper;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductAminService
{
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }

    protected function isValidPrice($request)
    {
        if ($request->input('price') != 0 && $request->input('price_sale') != 0
            && $request->input('price_sale') >= $request->input('price')
        ) {
            Session::flash('error', 'Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }

        if ($request->input('price') == 0 && $request->input('price_sale') != 0) {
            Session::flash('error', 'Vui lòng nhập giá gốc');
            return false;
        }
        return true;
    }

    public function insert($request)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;
//        $data = $request->all();
        if ($request->hasFile('file')) {
            $thumb = Helper::uploadFile($request->file);
//            $data['thumb'] = $thumb;
        }
        try {
            $request->except('_token');
//            Product::create($data);
            Product::create([
                'name' => $request->input('name'),
                'menu_id' => $request->input('menu_id'),
                'price' => $request->input('price'),
                'price_sale' => $request->input('price_sale'),
                'description' => $request->input('description'),
                'content' => $request->input('content'),
                'active' => $request->input('active'),
                'thumb' => $thumb,
            ]);
            Session::flash('success', 'Thêm sản phẩm thành công');

        } catch (\Exception $err) {
            Session::flash('error', 'Thêm sản phẩm lỗi');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function getAll()
    {
        return Product::with('menu')->orderBy('id', 'DESC')->paginate(10);
    }

    public function update($data ,$id) {
//        $isValidPrice = $this->isValidPrice($request);
//        if ($isValidPrice === false) return false;
//        $product = Product::where('id',$id)->first();
//        if ($request->hasFile('file')) {
//            $thumb = Helper::uploadFile($request->file);
////            $data['thumb'] = $thumb;
//        }
        $product = Product::find($id);
        if (!empty($product)) {
            $product = $product->update($data);
            if ($product) {
                Session::flash('success','Cập nhật sản phẩm thành công');
                return true;
            } else {
                Session::flash('error','Xóa sản phẩm lỗi');
                return false;
            }
        } else {
            Session::flash('error','Không tìm thấy bản ghi');
            return false;
        }
    }

    public function create($data)
    {
        return Product::query()->create($data);
    }

    public function delete($id) {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            Session::flash('success','Xóa thành công sản phẩm');
        }
        else {
            Session::flash('error','Xóa sản phẩm thất bại');
            return false;
        }
        return true;
    }

}
