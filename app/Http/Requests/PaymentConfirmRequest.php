<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentConfirmRequest extends FormRequest
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
            'surname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'post_code' => 'required|min:4',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ad sahəsi boş buraxıla bilməz!',
            'surname.required' => 'Soyad sahəsi boş buraxıla bilməz!',
            'email.required' => 'Email sahəsi boş buraxıla bilməz!',
            'email.email' => 'Yanlış Email formatı daxil olunub!',
            'phone.required' => 'Telefon sahəsi boş buraxıla bilməz!',
            'address.required' => 'Ünvan sahəsi boş buraxıla bilməz!',
            'city.required' => 'Şəhər sahəsi boş buraxıla bilməz!',
            'post_code.required' => 'Post Kodu sahəsi boş buraxıla bilməz!',
            'post_code.min' => 'Post Kodu minim 4 simvol olmalıdır',
        ];
    }
}
