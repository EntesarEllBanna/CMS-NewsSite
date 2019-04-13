<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'details' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
              'title.required' => "الرجاء ادخل عنوان الصفحة ",
              'details.required' => "الرجاء أدخل التفاصيل",
           
        ];
    }


}
