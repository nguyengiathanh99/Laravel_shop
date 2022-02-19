<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Cart\CartService;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(Request $request) {
        $result = $this->cartService->create($request);
        if ($result == false) {
            return redirect()->back();
        }
        return redirect()->route('list.cart');
    }

    public function show() {
        $products = $this->cartService->getProduct();
        $data = [
            'title' => 'Giỏ hàng',
            'products' => $products,
            'carts' => Session::get('carts'),
        ];
        return view('cart.list',$data);
    }

    public function update(Request $request) {
        $product = $this->cartService->update($request);
        if (empty($product)) {
            return redirect()->back();
        }
        return redirect()->route('list.cart');
    }

    public function delete($id) {
        $del_product = $this->cartService->delete($id);
        if ($del_product) {
            return redirect()->route('list.cart');
        }
        return redirect()->back();
    }

    public function orderProduct(Request $request) {
        $order = $this->cartService->orderProduct($request);
        if ($order) {
            return redirect()->back();
        }
        return "Đặt hàng không thành công";
    }
}
