<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'user_address' => 'required|string|max:255',
            'user_phone' => 'required|string|max:15',
            'receiver_email' => 'required|email|max:255',
            'receiver_name' => 'required|string|max:255',
            'receiver_address' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:15',
            'note' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get the custom messages for the validator.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'user_name.required' => 'Tên khách hàng là bắt buộc.',
            'user_name.string' => 'Tên khách hàng phải là chuỗi ký tự.',
            'user_name.max' => 'Tên khách hàng không được vượt quá 255 ký tự.',

            'user_email.required' => 'Email khách hàng là bắt buộc.',
            'user_email.email' => 'Email khách hàng phải là địa chỉ email hợp lệ.',
            'user_email.max' => 'Email khách hàng không được vượt quá 255 ký tự.',

            'user_address.required' => 'Địa chỉ khách hàng là bắt buộc.',
            'user_address.string' => 'Địa chỉ khách hàng phải là chuỗi ký tự.',
            'user_address.max' => 'Địa chỉ khách hàng không được vượt quá 255 ký tự.',

            'user_phone.required' => 'Số điện thoại khách hàng là bắt buộc.',
            'user_phone.string' => 'Số điện thoại khách hàng phải là chuỗi ký tự.',
            'user_phone.max' => 'Số điện thoại khách hàng không được vượt quá 15 ký tự.',

            'receiver_email.required' => 'Email người nhận là bắt buộc.',
            'receiver_email.email' => 'Email người nhận phải là địa chỉ email hợp lệ.',
            'receiver_email.max' => 'Email người nhận không được vượt quá 255 ký tự.',

            'receiver_name.required' => 'Tên người nhận là bắt buộc.',
            'receiver_name.string' => 'Tên người nhận phải là chuỗi ký tự.',
            'receiver_name.max' => 'Tên người nhận không được vượt quá 255 ký tự.',

            'receiver_address.required' => 'Địa chỉ người nhận là bắt buộc.',
            'receiver_address.string' => 'Địa chỉ người nhận phải là chuỗi ký tự.',
            'receiver_address.max' => 'Địa chỉ người nhận không được vượt quá 255 ký tự.',

            'receiver_phone.required' => 'Số điện thoại người nhận là bắt buộc.',
            'receiver_phone.string' => 'Số điện thoại người nhận phải là chuỗi ký tự.',
            'receiver_phone.max' => 'Số điện thoại người nhận không được vượt quá 15 ký tự.',

            'note.string' => 'Ghi chú phải là chuỗi ký tự.',
            'note.max' => 'Ghi chú không được vượt quá 1000 ký tự.',
        ];
    }
}

