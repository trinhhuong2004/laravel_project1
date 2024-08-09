<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
{
/**
* Determine if the user is authorized to make this request.
*/
public function authorize(): bool
{
return true;
}

/**
* Get the validation rules that apply to the request.
*
* @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
    */
    public function rules(): array
    {
    return [
    'name' => 'required|max:255',
    'url' => 'required|url',
    'sort_by' => 'required|integer',
    'is_active' => 'required|boolean',
    'thumb' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];
    }

    public function messages(): array
    {
    return [
    'name.required' => 'Tên danh mục bắt buộc phải điền.',
    'name.max' => 'Tên danh mục không được quá 255 ký tự.',
    'url.required' => 'URL bắt buộc phải điền.',
    'url.url' => 'URL không hợp lệ.',
    'sort_by.required' => 'Thứ tự sắp xếp bắt buộc phải điền.',
    'sort_by.integer' => 'Thứ tự sắp xếp phải là số nguyên.',
    'is_active.required' => 'Trạng thái hoạt động bắt buộc phải điền.',
    'is_active.boolean' => 'Trạng thái hoạt động phải là giá trị boolean.',
    'thumb.required' => 'Hình ảnh bắt buộc phải điền.',
    'thumb.image' => 'Tệp phải là hình ảnh.',
    'thumb.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
    'thumb.max' => 'Hình ảnh không được vượt quá 2MB.',
    ];
    }
    }
