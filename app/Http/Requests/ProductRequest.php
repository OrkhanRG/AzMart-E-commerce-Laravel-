<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'image|mimes:png,jpeg,jpg,gif',
            'price' => 'required',
            'category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Başlıq sahəsi boş buraxıla bilməz!',
            'price.required' => 'Qiymət sahəsi boş buraxıla bilməz!',
            'category_id.required' => 'Kateqoriya sahəsi boş buraxıla bilməz!',
            'image.image' => 'Yalnız şəkil yükləmək olar!',
            'image.mimes' => 'Yalnış şəkil formatı daxil olunub!',
        ];
    }
}
