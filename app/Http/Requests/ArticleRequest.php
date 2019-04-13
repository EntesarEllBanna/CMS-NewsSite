<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'category_id' => 'required',
            'details' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'title.required' => "الرجاء أدخل عنوان المقال",            
            'details.required' => "الرجاء أدخل التفاصيل",
            'category_id.required' => "الرجاء أدخل تصنيف المقال"
        ];
    }


}
