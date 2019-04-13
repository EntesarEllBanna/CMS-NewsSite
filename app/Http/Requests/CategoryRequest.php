<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;//اسمح للي مش عاملين تسجيل دخول انهم يتعاملو معها
    }

    //القيود تعتنها
    public function rules()
    {
        return [
            'title' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'title.required' => "الرجاء أدخل تصنيف المقال"
        ];
    }


}
