<?php

namespace App\Http\Controllers\CMS\Client;

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
        return view("frontend.index");
    }
    
    
    
    
    
    public function changepassword()
        
    {    
         $user=\Auth::user();
        
        $ClientId=Client::whereRaw("clients.user_id=$user->id")->first();//->id;
        $ClientId=$ClientId->id;
    
        
        
        $item=Client::find($ClientId);
       
        return view('cms.home.changeclientpassword',compact("item"));
    }
    
   
    public function postChangepassword(Request $request){
        
        $user=\Auth::user();
        
        $ClientId=Client::whereRaw("clients.user_id=$user->id")->first();//->id;
        $ClientId=$ClientId->id;
     
        
        $item=User::find($ClientId);
        $client=Client::find($ClientId);
        
        $item->name= $request["name"];
         $client->name= $request["name"];
        
        $item->email= $request["email"];
         $client->email= $request["email"];
        
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
			return redirect("/client/changepassword");
            
		}
		else
		{			
			\Session::flash("msg","e:كلمة المرور الحالية غير صحيحة");
			return redirect("/client/changepassword");
		}
        $item->save();
        $client->save();
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