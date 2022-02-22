<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ' الاسم مطلوب',
            'phone.required' => ' رقم الهاتف مطلوب',
            'phone.0.required' => ' رقم الهاتف مطلوب',
            'address.required' => ' العنوان مطلوب',

        ];
    }
}