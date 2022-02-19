<?php

namespace App\Http\Services\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Storage;

class SliderService
{
    public function insert($request) {
        if ($request->hasFile('file')) {
            $thumb = Helper::uploadFile($request->file);
        }
        #Insert
        $slider_add = Slider::create([
            'name' => $request->input('name'),
            'url' => $request->input('url'),
            'thumb' => $thumb,
            'sort_by' => $request->input('sort_by'),
            'active' => $request->input('active'),
        ]);
        if ($slider_add) {
            Session::flash('success', 'Thêm slider thành công');
            return true;
        }
        else {
            Session::flash('error', 'Xử lý lỗi');
            return false;
        }
    }

    public function getAll() {
        $slider = Slider::orderBy('id','desc')->paginate(15);
        if (empty($slider)) {
            return false;
        }
        return $slider;
    }

    public function update($data,$id) {
        $slider = Slider::find($id);
        if (!empty($slider)) {
            $slider = $slider->update($data);
            if ($slider) {
                Session::flash('success','Cập nhật slider thành công');
            }
        }
        else {
            Session::flash('error','Không tìm thấy bản ghi');
            return false;
        }
        return true;
    }

    public function delete($id) {
        $slider = Slider::where('id',$id)->first();
        if (!empty($slider)) {
            $path = "http://localhost/Laravelpro/shop/".$slider->thumb;
            Storage::delete($path);
            $slider->delete();
            return true;
        }
        Session::flash('error','Không tìm thấy slider');
        return false;
    }

    public function getSlider() {
        $slider = Slider::orderBy('id','desc')->get();
        if (!empty($slider)) {
            return $slider;
        }
        return false;
    }
}
