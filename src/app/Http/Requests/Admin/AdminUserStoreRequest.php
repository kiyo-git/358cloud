<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email:filter,dns', 'string', 'max:255', 'unique:admin_users,email,' . $this->id . ',id'],
            'role'      => ['required', 'integer', 'min:1', 'max:2'],
        ];

        // 更新時
        if (isset($this->id)) {
            $rules['password'] = ['nullable', 'string', 'regex:/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,24}+\z/i'];
        } else {
            $rules['password'] = ['required', 'string', 'regex:/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,24}+\z/i'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'     => '名前は必須です。',
            'name.string'       => '名前を正しく入力してください。',
            'name.max'          => '名前は255文字以内で入力してください。',
            'email.required'    => 'メールアドレスは必須です',
            'email.email'       => 'メールアドレスを正しく入力してください。',
            'email.string'      => 'メールアドレスを正しく入力してください。',
            'email.max'         => 'メールアドレスは255文字以内で入力してください。',
            'email.unique'      => '入力されたメールアドレスは登録済みです。',
            'password.required' => 'パスワードは必須です',
            'password.string'   => 'パスワードを正しく入力してください。',
            'password.regex'    => 'パスワードは半角英数字を最低1つずつ含めた8文字以上24文字以内で入力してください。',
            'role.required'     => '権限は必須です。',
            'role.integer'      => '権限が不正な値です。',
            'role.min'          => '権限が不正な値です。',
            'role.max'          => '権限が不正な値です。',
        ];
    }
}
