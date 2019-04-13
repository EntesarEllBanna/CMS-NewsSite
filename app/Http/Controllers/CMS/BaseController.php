<?php

namespace App\Http\Controllers\CMS;
use App\Admin;
use App\User;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Middleware\CheckPermission;


class BaseController extends Controller
{  
    
     function __construct() {
       \Session::put(["adminid"=>1]);
        $this->middleware('auth');
        $this->middleware('CheckPermission');
    }
    protected function UploadImage($request,&$image,$required=false){
		if ($request->file('image')!=NULL && $request->file('image')->isValid()) {
		  $destinationPath = 'uploads'; // upload path
		  // getting image extension
		  $extension = strtolower($request->file('image')->getClientOriginalExtension()); 
		  if($extension=="jpg" || $extension=="jpeg" 
		  	|| $extension=="gif" || $extension=="png"){
			  $image = uniqid().".$extension"; // renameing image			  
			  $request->file('image')->move($destinationPath, $image); 
			  return 1;
		  }
		  else{
			\Session::flash('msg',"e:يجب اختيار صورة صحيحة");
			return 0;
		  }
		}
		else {
			if($required){
				\Session::flash('msg', 'e:يجب اختيار صورة للصفحة');
				return 0;
			}
			else
				return 1;
		}
	}	
 
}

?>