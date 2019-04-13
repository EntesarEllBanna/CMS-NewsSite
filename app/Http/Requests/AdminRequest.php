<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;//اسمح للي مش عاملين تسجيل دخول انهم يتعاملو معها
    }

    //القيود تعتنها
    public function rules()
    {
        return [
            'fullname' => 'required',
            'email' => 'required|email',
           
        ];
    }
    
    public function messages()
    {
        return [
            'fullname.required' => " الرجاء ادخال اسم مستخدم",            
            'email.required' => "الرجاء أدخل الايميل",        
            'email.email' => "الرجاء أدخل بريد الالكتروني صحيح",
          
        ];
    }


}
