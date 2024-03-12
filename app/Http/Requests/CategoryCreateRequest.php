<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ad sahəsi boş buraxıla bilməz!',
            'image.image' => 'Yalnız şəkil yükləmək olar!',
            'image.mimes' => 'Yalnış şəkil formatı daxil olunub!',
        ];
    }
}
