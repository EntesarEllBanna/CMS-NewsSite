<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ClientsRequest;
use App\Http\Requests\CommentsRequest;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   public function register()
    {
        return view("auth.register");
    }

    public function signupclient(ClientsRequest $request)
    {
//echo "here";die();
	      $newclient= User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
		  ]);

		  $IsExists=Client::whereRaw("isdelete=0 and email=?",$request["email"])->count();
		  if($IsExists>0){
			\Session::flash("msg","e:".$request["name"]." موجود مسبقا لدينا ");
			return redirect("/signupclient");
		  }
		  $client = new Client();
		  $client->is_active = 1;
        $client->user_id=$newclient->id;
		  $client->name = $request["name"];
		  $client->email = $request["email"];
		  $client->isdelete=0;
		  $client->save();
          \Session::flash("msg","s:تمت عملية التسجيل بنجاح");
        return redirect("/login");
    }
    
     public function index()
    {
        return view('auth.login');
    }
    
    
//     public function addnaw(Request $request,$id)
//    {
//         $article=Article::whereRaw("id=? and isdelete=0 and active=1",[$id])->first();
//        if($article==NULL){
//            return redirect($request->url());}
//        
//        $mycomment=new Comment();
//        $mycomment->article_id=$id;
//        $mycomment->client_id=$item->id;
//        $mycomment->details=$request["details"];
//         $mycomment->isactive=1;
//          $mycomment->isdelete=0;
//        $mycomment->save();
//        \Session::flash("msg","s: تم تقديم طلبك بنجاح");
//        return redirect("/article/$id");      
//    }
//    
}
