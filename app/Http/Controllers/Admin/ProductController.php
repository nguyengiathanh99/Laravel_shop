<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Product\ProductAminService;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $productService;

    public function __construct(ProductAminService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {

        return view('admin.product.list', [
            'title' => 'Danh sách danh mục',
            'products' => $this->productService->getAll(),
        ]);

    }

    public function create()
    {
        $menu = $this->productService->getMenu();
        $data = [
            'title' => 'Thêm danh mục',
            'menus' => $menu,
        ];
        return view('admin.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

//        if ($request->hasFile('file')) {
//
//        }

//        $data = [
//            'name' => $request->input('name'),
//            'description' => $request->input('description')
//        ];

//        $product = new Product();
//        $product->name = $request->input('name');
//        $product->save();

//        if (!empty($product)) {
//          echo " oke thanh cong";
//        }
//
//        echo 'that bai';

//        $product = $this->productService->create($data);

//        if (!empty($product)) {
//            echo " oke thanh cong";
//        }
//
//        echo 'that bai';
        $this->productService->insert($request);
        return redirect('/admin/product/list');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $menu = Menu::where('active', true)->get();
//        $menu = $this->productService->getMenu();

        $data = [
            'title' => 'Chỉnh sửa sản phẩm',
            'menus' => $menu,
            'product' => $product,
        ];
        return view('admin.product.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only(['name', 'description','thumb','content','menu_id','price','price_sale','active']);
        if ($request->hasFile('file')) {
            $thumb = Helper::uploadFile($request->file);
//            $data['thumb'] = $thumb;
            $data['thumb'] = $thumb;
        }

        $product = $this->productService->update($data, $id);
        if (!$product) {
            return redirect()->back();
        }
        return redirect('/admin/product/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productService->delete($id);
        return redirect('/admin/product/list');
    }
}
