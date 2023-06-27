<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TransferUserUpdateRequest extends FormRequest
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
        return [
            "family_name" => "required|string",
            "given_name" => "required|string",
            "family_name_kana" => "required|regex:/[ァ-ヴー]+/u",
            "given_name_kana" => "required|regex:/[ァ-ヴー]+/u",
            'phone_number' => 'required|max:255|regex:/^[0-9]+$/',
            "year" => "required|integer|date_format:Y",
            "month" => "required||between:1,12",
            "day" => "required|between:1,31",
            "zip_code" => "required|digits:7",
            "prefecture" => "required",
            "city" => "required",
            "block" => "required",
            "email" => "required|email",
            "mailmagazine_flg" => "required|boolean",
            "id" => "required",

        ];
    }

    public function messages()
    {
        return [
            'id.required' => '不正なアクセスです。'
        ];
    }
}
