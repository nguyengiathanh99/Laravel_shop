<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;

class ClientMenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index($id) {
        $menu = $this->menuService->getId($id);

        $product = $this->menuService->getProduct($menu);

    }
}
