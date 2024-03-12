<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'fname' => 'required|string|min:3',
            'lname' => 'required|string|min:3',
            'email' => 'required|email',
            'subject' => 'required|min:3',
            'message' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'fname.required' => 'Ad sahəsi boş buraxıla bilməz!',
            'fname.string' => 'Ad sahəsi yalnız simvol ala bilər!',
            'fname.min' => 'Ad sahəsi minimum 3 simvol olmalıdır!',

            'lname.required' => 'Soyad sahəsi boş buraxıla bilməz!',
            'lname.string' => 'Soyad sahəsi yalnız simvol ala bilər!',
            'lname.min' => 'Soyad sahəsi minimum 3 simvol olmalıdır!',

            'email.required' => 'Email sahəsi boş buraxıla bilməz!',
            'email.email' => 'Email sahəsinə yalnız doğru email yazıla bilər!',

            'subject.required' => 'Mövzu sahəsi boş buraxıla bilməz!',
            'subject.min' => 'Mövzu sahəsi minimum 3 simvol olmalıdır!',

            'message.required' => 'Mesaj sahəsi boş buraxıla bilməz!',
        ];
    }
}
