<?php

namespace App\Http\Services\Cart;

use App\Models\Cart;
use App\Models\Customers;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;


class CartService
{
    public function create($request)
    {
        $qty = (int)$request->input('num_product');
        $product_id = $request->input('product_id');

        if ($qty <= 0 || $product_id <= 0) {
            Session::flash('error','Số lượng hoặc sản phẩm không chính xác');
            return false;
        }

        $carts = Session::get('carts');
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => $qty
            ]);
            return true;
        }
        $exists = Arr::exists($carts, $product_id);
        if ($exists) {
            $carts[$product_id] = $carts[$product_id] + $qty;
            Session::put('carts',$carts);
            return true;
        }

        $carts[$product_id] = $qty;
        Session::put('carts',$carts);

        return true;
    }


    public function getProduct() {
        $carts = Session::get('carts');
        if (is_null($carts)) {
            return false;
        }
        $product_Id = array_keys($carts);
        return Product::select('id','name','thumb','price','price_sale')
            ->whereIn('id',$product_Id)
            ->where('active',1)
            ->get();
    }

    public function update($request) {
       Session::put('carts',$request->input('num_product'));
       return true;
    }

    public function delete($id) {
        $carts = Session::get('carts');
        unset($carts[$id]);
        Session::put('carts',$carts);
        return true;
    }

    public function orderProduct($request) {
        $carts = Session::get('carts');
        if (is_null($carts)) {
            return false;
        }
        $customer = Customers::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'content' => $request->input('content')
        ]);
        $this->infoProduct($carts,$customer->id);
        if (empty($customer)) {
            Session::flash('error','Đặt hàng thất bại');
            return false;
        }
        Session::flash('success','Đặt hàng thành công');
        Session::forget('carts');
        return true;
    }

    public function infoProduct($carts,$customer_id) {
        $product_Id = array_keys($carts);

        $products = Product::select('id','name','thumb','price','price_sale')
            ->whereIn('id',$product_Id)
            ->where('active',1)
            ->get();
        $data = [];
        if (!empty($products)) {
            foreach ($products as $product) {
                $data[] = [
                    'customer_id' => $customer_id,
                    'product_id' => $product->id,
                    'qty' => $carts[$product->id],
                    'price' => $product->price_sale != 0 ? $product->price_sale : $product->price
                ];
            }
        }
        return Cart::insert($data);
    }
}
