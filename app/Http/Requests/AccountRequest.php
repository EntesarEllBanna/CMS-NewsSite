<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;//اسمح للي مش عاملين تسجيل دخول انهم يتعاملو معها
    }

    //القيود تعتنها
    public function rules()
    {
        return [
            'email' => 'required|email',
            'fullname' => 'required',
            'country' => 'required',
            'gender' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'email.required' => "Please enter Email Address",
            'fullname.required' => "Please enter Full Name"
        ];
    }


}
