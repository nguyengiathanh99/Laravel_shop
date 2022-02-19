<?php

namespace App\Http\Services\Menu;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\False_;
use phpDocumentor\Reflection\Types\True_;
use PHPUnit\Exception;

class MenuService
{
    public function getParent() {
        return Menu::where('parent_id',0)->get();
    }

    public function getAll() {
        return Menu::orderBy('id')->paginate(10);
    }

    public function create($request) {
        try {
            Menu::create([
                'name' => $request->input('name'),
                'parent_id' => $request->input('parent_id'),
                'description' => $request->input('description'),
                'content' => $request->input('detail_desc'),
                'active' => $request->input('active'),
            ]);
            Session::flash('success','Thêm danh mục thành công');
        }catch (\Exception $err) {
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($id) {
        $menu = Menu::find($id);
        if ($menu) {
            return Menu::where('id',$id)->orWhere('parent_id',$id)->delete();
        }
        return false;
    }

//    public function update($menuId,$data) : bool
//    {
//        $menu = Menu::query()->where('id', $menuId)->first();
//        if (empty($menu)) {
//            return false;
//        }
//
//        $menu1 = $menu->update($data);
//        if (!$menu1) {
//            return false;
//        }
//        return true;
//        }

    public function update($id,$data) : bool {
        $menu = Menu::find($id);
        if (empty($menu)) {
            return false;
        }
        $menu_update = $menu->update($data);

        if (!$menu_update) {
            return false;
        }
        return true;
    }

    public function showMenu() {
        $menus =  Menu::select('id','name')->where('parent_id',0)->get();
        if (!empty($menus)) {
            return $menus;
        }
        return false;
    }

    public function getId($id) {
        return Menu::where('id',$id)->where('active',1)->firstOrFail();
    }

    public function getProduct($menu) {
        return $menu->products()->get();
    }
}
