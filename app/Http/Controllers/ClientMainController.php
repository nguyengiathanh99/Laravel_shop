<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Product\ProductService;

class ClientMainController extends Controller
{
    protected $menu;
    protected $slider;
    protected $product;

    public function __construct(SliderService $slider, MenuService $menu, ProductService $product)
    {
        $this->menu = $menu;
        $this->slider = $slider;
        $this->product = $product;
    }

    public function index() {
        return view('home',[
            'title' => 'Shop nước hoa',
            'menus' => $this->menu->showMenu(),
            'sliders' => $this->slider->getSlider(),
            'products' => $this->product->getAll(),
        ]);
    }
}
