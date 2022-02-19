<?php

namespace App\View\Composers;

namespace App\View\Composers;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CartComposer
{

    public function compose(View $view)
    {
        $carts = Session::get('carts');

        if (!empty($carts)) {
            $products_Id = array_keys($carts);
            if (isset($products_Id)) {
                $products = Product::select('id','name','thumb','price','price_sale')
                    ->whereIn('id',$products_Id)
                    ->where('active',1)
                    ->get();
            }
            $view->with('$products',$products);
        }
    }
}
