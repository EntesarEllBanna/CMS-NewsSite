<?php

namespace App\Http\Controllers\CMS\Client;

use App\User;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Admin;
use App\Comment;
use App\Http\Requests\ArticleRequest;
use App\Category;
use App\Article;
use App\Client;
class ArticleController extends BaseController
{  
     
     public function allComments(Request $request, $id)
     {
         $user = \Auth::user();
         $article = Article::find($id);
         
        if($article==NULL){
            \Session::flash("msg","e: الرابط المطلوب غير موجود");
        
            return redirect("/cms/article/{id}");
        }
      $q = $request["q"]; 
         $comment =Comment::whereRaw("comments.is_delete=0 and comments.isactive=1");
        $isAdmin=\DB::table("admin")->where("user_id",$user->id)->count();
          $isClient=\DB::table("clients")->where("user_id",$user->id)->count();
      
         
         if($isClient)
         {
           $client=Client::whereRaw("user_id=$user->id and clients.isdelete=0 and clients.is_active=1")->first();  
          $comment =$comment->leftJoin("clients","client_id","clients.id")->whereRaw("article_id = ?",["$id"] );
 if ($q!=NULL)
      $comment=$comment->whereRaw("comments.is_delete=0 and comments.isactive=1 and(clients.name like ? or comments.details like ?)",["%$q%","%$q%"]);
       $comment=$comment->paginate(10)->appends(["q"=>$q]);
      
      return view("cms.article.EveryComments"
                  ,compact("comment","q","article","client"));
     
         }
         
         
         if($isAdmin)
         {
          $admin=Admin::whereRaw("user_id=$user->id and admin.isdelete=0 and admin.active=1")->first();
        $comment =$comment->leftJoin("admin","admin_id","admin.id")->whereRaw("article_id = ?",["$id"] );
 if ($q!=NULL)
      $comment=$comment->whereRaw("comments.is_delete=0 and comments.isactive=1 and(admin.fullname like ? or comments.details like ?)",["%$q%","%$q%"]);
      
      $comment=$comment->paginate(10)->appends(["q"=>$q]);
      
      return view("cms.article.EveryComments"
                  ,compact("comment","q","article","admin"));
         }
           
     }
    
    

}