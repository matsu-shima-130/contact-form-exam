<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'last_name'   => ['required'],
            'first_name'  => ['required'],
            'gender'      => ['required','in:1,2,3'],
            'email'       => ['required','email'],
            'tel1'        => ['required'],
            'tel2'        => ['required'],
            'tel3'        => ['required'],
            'address'     => ['required'],
            'building'    => ['nullable'],
            'category_id' => ['required','exists:categories,id'],
            'content'      => ['required','max:120'],
        ];
    }

    public function messages()
    {
        return [
            'last_name.required'   => '姓を入力してください',
            'first_name.required'  => '名を入力してください',
            'gender.required'      => '性別を選択してください',
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',
            'tel1.required'        => '電話番号を入力してください',
            'tel2.required'        => '電話番号を入力してください',
            'tel3.required'        => '電話番号を入力してください',
            'address.required'     => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'category_id.exists'   => 'お問い合わせの種類を選択してください',
            'content.required'      => 'お問い合わせ内容を入力してください',
            'content.max'           => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}
