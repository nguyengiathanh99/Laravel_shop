<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;

class ClientProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function index($id) {
        $product = $this->productService->show($id);
        $productMore = $this->productService->more($id);
        $data = [
            'name' => $product->name,
            'product' => $product,
            'products' => $productMore,
            'title' => 'Chi tiết sản phẩm'
        ];
        return view('product.content',$data);
    }
}
