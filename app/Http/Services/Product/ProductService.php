<?php

namespace App\Http\Services\Product;

use App\Models\Product;

class ProductService
{
    public function getAll() {
        $products = Product::select('id','name','thumb','price','price_sale')->orderBy('id','desc')->paginate(16);
        if (!empty($products)) {
            return $products;
        }
        return false;
    }

    public function show($id) {
        $products = Product::where('id',$id)
            ->with('menu')
            ->firstOrFail();
        if (!empty($products)) {
            return $products;
        }
        return false;
    }

    public function more($id) {
        $products = Product::where('id','!=',$id)->where('active',1)->orderBy('id','desc')->limit(8)->get();
        if (!empty($products)) {
            return $products;
        }
        return false;
    }
}

