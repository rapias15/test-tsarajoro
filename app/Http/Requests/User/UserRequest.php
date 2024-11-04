<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'firstname' => ['required', 'min:4'],
            'lastname' => ['required', 'min:4'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:4'],
            'confirmPassword' => ['required', 'min:4'],
        ];
    }
}
