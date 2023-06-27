<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterTransferRequest extends FormRequest
{
    // protected $redirect = '/';
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
        return [
            'phone_number' => 'required|max:255|regex:/^[0-9]+$/',
            "family_name" => "required|string",
            "given_name" => "required|string",
            "family_name_kana" => "required|regex:/[ァ-ヴー]+/u",
            "given_name_kana" => "required|regex:/[ァ-ヴー]+/u",
            "year" => "required|integer|date_format:Y",
            "month" => "required||between:1,12",
            "day" => "required|between:1,31",
            "zip_code" => "required|digits:7",
            "prefecture" => "required",
            "city" => "required",
            "block" => "required",
            "email" => "required|email|confirmed:email",
            "password" => "required|regex:/^(?=.*?[a-zA-Z])(?=.*?\d)[a-zA-Z\d]{8,15}$/|confirmed:password",//半角英数８桁以上15以内
            "mailmagazine" => "required|boolean",
            "term" => "required",
        ];
    }

    /**
     *  このメソッドを追記
     * @param $validator
     */
    public function withValidator($validator)
    {
        // バリデーション完了後
        $validator->after(function ($validator) {
           // 入力エラーがあった場合
           if ($validator->errors()->any()) {
            return redirect()->back()->withInput()->withErrors($validator);
           }
        });
    }
}
