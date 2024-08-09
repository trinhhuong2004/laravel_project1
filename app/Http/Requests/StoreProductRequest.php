<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Bạn có thể điều chỉnh theo yêu cầu quyền truy cập
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'price_sale' => 'required|numeric|min:0',
            'description' => 'required|string',
            'img_thumb' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_variants.*.quantity' => 'required|integer|min:0',
            'product_variants.*.price_variant' => 'required|numeric|min:0',
            'product_variants.*.price_sale_variant' => 'required|numeric|min:0',
            'product_variants.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'sku' => 'required|string|unique:products,sku'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống.',
            'price.required' => 'Giá sản phẩm không được để trống.',
            'price_sale.required' => 'Giá khuyến mại không được để trống.',
            'description.required' => 'Mô tả không được để trống.',
            'img_thumb.image' => 'Hình ảnh chính không hợp lệ.',
            'product_variants.*.quantity.required' => 'Số lượng không được để trống.',
            'product_variants.*.price_variant.required' => 'Giá niêm yết không được để trống.',
            'product_variants.*.price_sale_variant.required' => 'Giá sale không được để trống.',
            'category_id.required' => 'Danh mục sản phẩm không được để trống.',
            'sku.required' => 'Mã sản phẩm không được để trống.',
            'sku.unique' => 'Mã sản phẩm đã tồn tại.',
        ];
    }
}
