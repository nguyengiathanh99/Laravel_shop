<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Models\Menu;
use App\Http\Services\Menu\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService) {
        $this->menuService = $menuService;
    }

    public function create() {
        return view('admin.menu.create',[
            'title' => 'Thêm Danh Mục',
            'menus' => $this->menuService->getParent()
        ]);
    }

    public function store(CreateFormRequest $request) {
        $this->menuService->create($request);
        return redirect('/admin/menu/list');
    }

    public function index() {
        return view('admin.menu.list',[
            'title' => 'Danh sách danh mục',
            'menus' => $this->menuService->getAll(),
        ]);
    }

    public function delete($id) {
        $this->menuService->delete($id);
        return redirect('/admin/menu/list');
    }

    public function show(Menu $menu) {

        return view('admin.menu.edit',[
            'title' => 'Cập nhật danh mục',
            'menu' => $menu,
            'menus' => $this->menuService->getParent(),
        ]);
    }

//    public function update($id,CreateFormRequest $request) {
//        /*$data = [];
//        $data['name'] = $request->name;
//        $data['parent_id'] = $request->parent_id;
//        $data['description'] = $request->description;
//        $data['content'] = $request->get('content');
//        $data['active'] = $request->active;*/
////
//        $data = $request->only(['name', 'parent_id', 'description', 'content', 'active']);
//        $menu = $this->menuService->update($id,$data);
//        if (!$menu) {
//            Session::flash('error','Khong  update');
//        }
//        Session::flash('success','Cập nhật danh mục thành công');

////        $menu = Menu::query()->where('id', $id)->first();
////        if (empty($menu)) {
////            echo " khoong tim thay du lieu";
////        }
////        if (id = parent) {
////            echo 'khong';
////            return back();
////        }
//        return redirect()->back();
//    }

        public function update($id,CreateFormRequest $request) {
            $data = $request->only(['name', 'parent_id', 'description', 'content', 'active']);
            $menu = $this->menuService->update($id,$data);
            if (!$menu) {
                Session::flash('error','Update danh mục không thành công');
            }
            Session::flash('success','Cập nhật danh mục thành công');
            return redirect('/admin/menu/list');
        }

//    public function update(Request $request,$id) {
//        $menu = Menu::find($id);
//        if (empty($menu)) {
//            Session::flash('message','Không tìm thấy id');
//        }
//        $menu_update = $menu->update([
//            'name' => $request->input('name'),
//            'parent_id' => $request->input('parent_id'),
//            'description' => $request->input('description'),
//            'content' => $request->input('detail_desc'),
//            'active' => $request->input('active'),
//        ]);
//        if (!$menu_update) {
//            Session::flash('error','Cập nhật danh mục thất bại');
//        }
//        Session::flash('success','Cập nhật danh mục thành công');
//        return redirect()->back();
//    }
}
