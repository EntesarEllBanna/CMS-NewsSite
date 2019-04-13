<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'url' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
              'title.required' => "الرجاء ادخل عنوان الشريحة ",
              'url.required' => "الرجاء ادخل الرابط ",
           
        ];
    }


}
