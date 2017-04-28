<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'min:3',
            'email' => 'nullable|email|unique:contacts',
            'phone' => 'min:7|regex:/\+?(\d\s?\-?)+/',
            'address' => 'nullable|min:10',
            'birthday' => 'nullable|date',
            'company_name' => 'nullable|min:3'
        ];
    }
}
