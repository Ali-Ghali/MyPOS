<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'category_id' => 'required',
            'name' => 'required_without:id',
            'description' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'اسم القسم مطلوب',
            'name.required' => 'اسم المنتج مطلوب',
            'description.required' => 'وصف المنتج مطلوب',
            'purchase_price.required' => 'سعر الشراء مطلوب',
            'sale_price.required' => 'سعر البيع مطلوب',
            'stock.required' => 'المخزن مطلوب',
            'name.required_without'  => 'اسم المنتج مطلوب',


        ];
    }
}