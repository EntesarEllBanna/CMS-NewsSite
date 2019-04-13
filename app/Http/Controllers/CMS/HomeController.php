<?php

namespace App\Http\Controllers\CMS;

use App\User;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Client;
use App\Admin;

class HomeController extends BaseController
{  
    
    public function index()
    {
        return view("cms.home.index");
    }
    
    
    public function noaccess()
    {
        return view('cms.home.noaccess');
    }
    
    
    public function changepassword()
    {
        //echo $this->adminid;
        
         $item=Admin::find($this->adminid);
        return view('cms.home.changepassword',compact("item"));
    }
    
   
    public function postChangepassword(Request $request){
        
        $item=Admin::find($this->adminid);
        $item2=User::find($this->adminid);
        
        $item->name= $request["name"];
         $item2->name= $request["name"];
        
        $item->email= $request["email"];
        $item2->email= $request["email"];
        
		$this->validate($request, [
        'oldpassword' => 'required',
        'password' => 'required|min:4|confirmed',
    	],
                       ["oldpassword.required"=>"الرجاء ادخل كلمة المرور الحالية",
                       "password.required"=>"الرجاء ادخل كلمة المرور الجديدة",
                       "password.min"=>"كلمة المرور الجديدة على الاقل 4 احرف",
                       "password.confirmed"=>"تأكيد كلمة المرور يجب ان يطابق الكلمة الجديدة"]);
		
		//المستخدم اللي عامل دخول
		$user = \Auth::user();
		
		if($this->IsValidOldPassword($request->input("oldpassword")))
		{
			$user->password=bcrypt($request->input("password"));
			$user->save();			
			\Session::flash("msg","s:تمت عملية الحفظ بنجاح");
			return redirect("cms/home/changepassword");
            
		}
		else
		{			
			\Session::flash("msg","e:كلمة المرور الحالية غير صحيحة");
			return redirect("cms/home/changepassword");
		}
        $item->save();
        $item2->save();
	}
    
    
    
	function IsValidOldPassword($password)
	{
		$user = \Auth::User();
		
		$credentials2 = ['email' => $user->email, 
			'password' => $password];

		if (\Auth::validate($credentials2)) {
			return 1;
		}
		else
			return 0;
	}
    
}

?>