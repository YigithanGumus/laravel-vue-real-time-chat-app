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
            'username' => 'required|string|min:3|max:30|unique:users,username',
            'name' => 'required|string|min:3|max:60',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6'
        ];
    }

    /*public function messages()
    {
        return [
          'username.required'=> "Kullanıcı adı girilmesi zorunludur!",
          'username.string'=>"Lütfen sadece sayısal içerik girmeyiniz!",
          'username.min'=> "Kullanıcı adı minimum 3 karakter girilebilir!",
          'username.max'=> "Kullanıcı adı maksimum 30 karakter girilebilir!",
          'username.unique'=> "Bu kullanıcı mevcuttur!",
          'name.required'=> "İsim ve Soyadı girilmesi zorunludur!",
          'name.string'=> "Girdiğiniz içerik hatalıdır!",
          'name.min'=> "Minimum 3 karakter girilebilir!",
          'name.max'=> "Minimum 60 karakter girilebilir!",
        ];
    }*/
}
