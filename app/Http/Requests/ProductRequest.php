<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'category_id' => 'required',
            'name' => 'required|unique:products,name' . $this->id,
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
            'name.unique' => 'اسم المنتج موجود',

        ];
    }
}