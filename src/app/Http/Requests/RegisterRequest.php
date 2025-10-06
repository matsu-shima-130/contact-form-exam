<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required','string','max:255'],
            'email'    => ['required','string','email','max:255', Rule::unique('users','email')],
            'password' => ['required','string','min:8'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'       => 'お名前を入力してください',
            'email.required'      => 'メールアドレスを入力してください',
            'email.email'         => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'email.unique'        => 'このメールアドレスは既に登録されています',
            'password.required'   => 'パスワードを入力してください',
            'password.min'        => 'パスワードは8文字以上で入力してください',
        ];
    }
}
