<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Models\Slider;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Session;


class SliderController extends Controller
{
    protected $slider;

    public function __construct(SliderService $sliderService)
    {
        $this->slider = $sliderService;
    }

    public function add() {
        return view('admin.slider.add',[
            'title' => 'Thêm mới Slider'
        ]);
    }

    public function store(Request $request) {
        $this->validate($request,[
            'name' => 'required',
            'url' => 'required',
        ]);
        $this->slider->insert($request);
        return redirect()->route('admin.slider.list');
    }

    public function index() {
        $data = [
            'title' => 'Danh sách slider',
            'sliders' => $this->slider->getAll(),
        ];
        return view('admin.slider.list',$data);
    }

    public function show($id) {
        $slider = Slider::find($id);
        $data = [
            'title' => 'Chỉnh sửa slider',
            'slider' => $slider
        ];
        return view('admin.slider.edit',$data);
    }

    public function update (Request $request,$id) {
        $this->validate($request,[
            'name' => 'required',
            'url' => 'required',
        ]);
        $data = $request->only(['name','url','thumb','sort_by','active']);
        if ($request->hasFile('file')) {
            $thumb = Helper::uploadFile($request->file);
            $data['thumb'] = $thumb;
        }
        $slider = $this->slider->update($data,$id);
        if (!$slider) {
            return redirect()->back();
        }
        return redirect()->route('admin.slider.list');
    }

    public function delete($id) {
        $slider_del = $this->slider->delete($id);
        if ($slider_del) {
            Session::flash('success','Xóa slider thành công');
            return redirect()->route('admin.slider.list');
        }
        else {
            Session::flash('error','Xóa slider thất bại');
            return redirect()->back();
        }
    }
}
