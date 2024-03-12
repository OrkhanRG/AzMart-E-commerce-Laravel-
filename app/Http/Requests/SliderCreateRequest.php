<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderCreateRequest extends FormRequest
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
            'title' => 'required',
            'image' => 'image|mimes:png,jpeg,jpg,gif',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Başlıq sahəsi boş buraxıla bilməz!',
            'image.image' => 'Yalnız şəkil yükləmək olar!',
            'image.mimes' => 'Yalnış şəkil formatı daxil olunub!',
        ];
    }
}
