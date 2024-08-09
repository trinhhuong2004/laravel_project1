<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    const PATH_VIEW = 'admins.products.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::query()->with(['category'])->latest('id')->get();
//        dd($data);
        return view(self::PATH_VIEW.__FUNCTION__,[
            'title' => 'Danh sách sản phẩm',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->pluck('name', 'id')->all();
        return view(self::PATH_VIEW.__FUNCTION__,[
            'title' => 'Thêm mới sản phẩm',
            'categories' => $categories,
        ]);

//        return view(self::PATH_VIEW.'show');
    }
    public function create_variant()
    {
        $categories = Category::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();

        return view(self::PATH_VIEW.__FUNCTION__,[
            'title' => 'Thêm mới sản phẩm',
            'categories' => $categories,
            'sizes' => $sizes,
            'colors' => $colors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
//         dd($request->all());
        // Boc tach data
        $dataProduct = $request->except(['product_variants', 'img_thumb', 'product_galleries']);
        $dataProduct['is_best_sale'] = isset($dataProduct['is_best_sale']) ? 1 : 0;
        $dataProduct['is_40_sale'] = isset($dataProduct['is_40_sale']) ? 1 : 0;
        $dataProduct['is_hot_online'] = isset($dataProduct['is_hot_online']) ? 1 : 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name'] . '_' . $dataProduct['sku']);
//        dd($dataProduct);
        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants = [];
        foreach ($dataProductVariantsTmp as $key => $item){
//            dd($key, $item);
            $tmp = explode('_', $key);
            $dataProductVariants[] = [
                'product_size_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'image' => $item['image'] ?? null,
                'quantity' => $item['quantity'],
                'price_variant' => $item['price_variant'],
                'price_sale_variant' => $item['price_sale_variant'],
            ];
        }
//        dd($dataProductVariants);
        if ($request->hasFile('img_thumb')) {
            $dataProduct['img_thumb'] = $request->file('img_thumb')->store('upload/products', 'public');
        }
        $dataProduct_galleries = $request->product_galleries;

        try {
            DB::beginTransaction();
            $product = Product::query()->create($dataProduct);

            foreach ($dataProductVariants as $dataProductVariant){
                $dataProductVariant['product_id'] = $product->id;
                if($dataProductVariant['image']){
                    $dataProductVariant['image'] = $dataProductVariant['image']->store('upload/product_variants', 'public');
                }
                ProductVariant::query()->create($dataProductVariant);
            }
            foreach ($dataProduct_galleries as $image){
                ProductGallery::query()->create([
                    'product_id' => $product->id,
                    'image' => $image->store('upload/product_galleries', 'public')
                ]);
            }
            DB::commit();
            return redirect()->route('admins.products.index')->with('success', 'Thêm sản phẩm thành công');

        }catch (\Exception $exception){
            DB::rollBack();
            dd($exception->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Lấy sản phẩm dựa trên ID
        $product = Product::with(['category', 'galleries', 'variants'])->findOrFail($id);
//        dd($product->all());
        return view(self::PATH_VIEW.__FUNCTION__, [
            'title' => 'Chi tiết sản phẩm',
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Tạo tiêu đề cho trang
        $title = 'Cập nhật sản phẩm';

        // Lấy danh sách các danh mục, màu sắc, và kích thước sản phẩm
        $categories = Category::query()->get();
        $product = Product::query()->findOrFail($id);
//        dd($product);
        // Trả về view với các dữ liệu
        return view(self::PATH_VIEW . __FUNCTION__, compact('title', 'product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( Product $product, $id)
    {
        dd($product->all());

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Trong thực tế, chức năng xóa phải là xóa mềm
        // Dưới đây code chỉ dành cho làm cơ bản
        try {
            $dataHasImage = $product->galleries->toArray() + $product->variants->toArray();

            DB::transaction(function () use ($product) {
                $product->galleries()->delete();

                // Đoạn foreach này là 1 phần lý do chúng ta không làm xóa cứng, mà chỉ làm xóa mềm
                // Như các em thấy, nó đang ảnh hưởng đến phần Order.
                foreach ($product->variants as $variant) {
                    $variant->orderItems()->delete();
                }
                $product->variants()->delete();

                $product->delete();
            }, 3);

            foreach ($dataHasImage as $item) {
                if (!empty($item->image) && Storage::exists($item->image)) {
                    Storage::delete($item->image);
                }
            }

            return back()->with('success', 'Thao tác thành công');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }


}
