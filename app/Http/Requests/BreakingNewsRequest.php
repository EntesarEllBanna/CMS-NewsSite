<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BreakingNewsRequest extends FormRequest
{
    public function authorize()
    {
        return true;//اسمح للي مش عاملين تسجيل دخول انهم يتعاملو معها
    }

    //القيود تعتنها
    public function rules()
    {
        return [
            'news' => 'required',
            'period' => 'required'
        ];
    }
    
    public function messages()
    {
        return [
            'news.required' => "الرجاء أدخل عنوان الخبر",            
            'period.required' => "الرجاء أدخل الفترة"
        ];
    }


}
