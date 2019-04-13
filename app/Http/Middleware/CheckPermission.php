<?php

namespace App\Http\Middleware;
use App\Admin;
use Closure;
use View;
use App\Client;
class CheckPermission 
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
		$user = \Auth::user();
		//echo $user->id;
        //die();		
		//الرابط المطلوب
        //App\Http\Controllers\CMS\CategoryController@index
		$currentAction = \Route::currentRouteAction();
		if($user!=NULL){
            
            $admin=Admin::where("user_id",$user->id)->count();
            $client=Client::where("user_id",$user->id)->count();
            if($admin){
                $admin=Admin::where("user_id",$user->id)->first();
            \Session::flash("adminId",$admin->id);
			//الرابط المطلوب
			//example  App\Http\Controllers\FooBarController@index
			list($controller, $method) = explode('@', $currentAction);
			// $controller now is "App\Http\Controllers\FooBarController"		
			$controller = strtolower(preg_replace('/.*\\\/', '', $controller));
			$controller=str_replace("controller","",$controller);			
			if($method=="index")
				$method="";
            else
                $method="/$method";
			$url="/cms/$controller".$method;
			//echo $url;die();
            //بسأل جدول اللينكات هل يحتوي على الرابط المطلوب؟؟؟؟
			$link=\DB::table("link")->where("url",$url)->first();
            //echo $link->id;
            //die();
			//معناه انه الرابط عليه صلاحيات
			if($link!=NULL)
			{
				$haveAdminThisLink=\DB::table("admin_link")
					->where("link_id",$link->id)
					->where("admin_id",$admin->id)
					->count();
				if(!$haveAdminThisLink){					
					return redirect('/cms/home/noaccess');
				}
			}
		}
             else if($client){
        \Session::flash("msg","w:There is no access");
        return redirect('/');
    }
        return $response;
    }}
    
   
        
}
