<?php

namespace App\View\Composers;
use App\Models\Menu;
use Illuminate\View\View;


class MenuComposer
{
    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $menus = Menu::select('id','name','parent_id')->where('active',1)->orderBy('id','desc')->get();
        $view->with('menus',$menus);
    }
}
