<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientsRequest extends FormRequest
{
    public function authorize()
    {
        return true;//اسمح للي مش عاملين تسجيل دخول انهم يتعاملو معها
    }

    //القيود تعتنها
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
           
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => " الرجاء ادخال اسم مستخدم",            
            'email.required' => "الرجاء أدخل الايميل",        
            'email.email' => "الرجاء أدخل بريد الالكتروني صحيح",
          
        ];
    }


}
