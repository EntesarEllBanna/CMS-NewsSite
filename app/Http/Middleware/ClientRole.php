<?php

namespace App\Http\Middleware;

use Closure;

class ClientRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    { 
        if(\Auth::check()) {    
            $user_id = $request->user()->id;
            $Client=\DB::table("clients")->where("user_id",$user_id)->count();
            if(!$Client){
                \Session::flash("msg","e: الرجاء التأكد من أنك مسجل كزائر");
                return redirect("/login");
            }
        }
        return $next($request);
    }
}
