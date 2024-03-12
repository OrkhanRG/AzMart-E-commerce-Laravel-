<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed:password_confirma', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'name.min' => 'Ad Soyad sahəsi ən az 3 simvoldan ibarət olmalıdır!',
            'email.required' => 'Email sahəsini boş buraxmaq olmaz!',
            'email.unique' => 'Bu Email ilə daha əvvəl qeydiyyatdan keçilib!',
            'password.required' => 'Şifrə sahəsini boş buraxmaq olmaz!',
            'password.min' => 'Şifrə ən az 3 simvoldan ibarət olmalıdır!',
        ];
    }
}
