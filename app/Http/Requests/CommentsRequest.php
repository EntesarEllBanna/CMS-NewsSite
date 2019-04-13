<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentsRequest extends FormRequest
{
    public function authorize()
    {
        return true;//اسمح للي مش عاملين تسجيل دخول انهم يتعاملو معها
    }

    //القيود تعتنها
    public function rules()
    {
        return [
            
            'details' => 'String',
        ];
    }
    
    public function messages()
    {
        return [
             
              'details.String' => "الرجاء أدخل تعليق سليم",
           
        ];
    }


}
