<?php

namespace App\Http\Controllers\CMS;

use App\User;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Client;
use App\Comment;
use App\Http\Requests\ArticleRequest;
use App\Category;
use App\Article;

class ClientsController extends BaseController
{  
    
    public function index(Request $request)
    {
        $q = $request["q"];
       
        $active = $request["is_active"];
         $items = Client::whereRaw(" isdelete=0   and  (name like ? or email like ?)",["%$q%","%$q%"]);
       
        if($active!="")
            $items->where("is_active",$active);
        
        
        $items=$items->orderby("id","desc")->paginate(10)
            ->appends(["q"=>$q,"active"=>$active]);
        return view("cms.admin.clients",compact("items","q","active"));
    } 
    
public function destroy($id){
        $client = Client::find($id);
        
        
        $client->isdelete=1;
        
        $client->save();
    
        
        \Session::flash("msg","s: تمت عملية الحذف بنجاح");
        
        return redirect("/cms/clients");
      
//       return response()->json([
//           'status' => 1,
//            'msg' => "i:تمت عملية الحذف بنجاح"
//        ]);
    
   
    }    
    
    
public function active($id)
    {
        $item = Client::find($id);
        if($item==NULL)
            return "Invalid ID";
       
        $item->is_active=!$item->is_active;
           
        $item->save();
        
        return response()->json([
            'status' => 1,
            'msg' => 's:تمت عملية الحفظ بنجاح'
        ]);
    }
}