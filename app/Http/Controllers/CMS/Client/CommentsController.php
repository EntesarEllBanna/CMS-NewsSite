<?php


namespace App\Http\Controllers\CMS\Client;
use App\Admin;
use App\User;
use App\Comment;
use App\Article;
use App\Client;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests\ClientsRequest;
use App\Http\Requests\CommentsRequest;
use App\Page;


class CommentsController extends BaseController
{  
    
    public function index(Request $request)
    {
    }
    
    public function create()
    {

    }
   
    public function store(CommentsRequest $request)
    {      
       
    }    
     
    public function destroy($comments_id){
        $item = Comment::whereRaw("comments_id=$comments_id")->first(); 
        //::and isdelete=0 and active=1",[$id])
        if($item==NULL)
            return redirect("/cms/comments");
        $item->is_delete=1;
       
        $item->save();
        
        \Session::flash("msg","w:تمت عملية الحذف بنجاح");
        return redirect("/cms/comment/$item->article_id/all");
    }  
    
    
    public function edit($comments_id)
    {
        //$items=JobSeeker::where("seeker_id",$this->ClientId);
       $item = Comment::whereRaw("comments_id=$comments_id")->first(); 
        if($item==NULL){
            \Session::flash("msg","e: الرابط المطلوب غير موجود");        
            return redirect("/cms/comments");
        }
        return view("cms.comments.edit",compact("item"));
    }    
    
    public function update(CommentsRequest $request,$comments_id)
    {                
                 
       $item = Comment::whereRaw("comments_id=$comments_id")->first(); 
      
        $item->details= $request["details"];
        $item->save();
        
        \Session::flash("msg","s:تمت عملية الحفظ بنجاح");
        return redirect("/cms/comment/$comments_id/edit");
   }  
 
    
     public function addnaw(Request $request,$id)
    { 
         $user = \Auth::user();
         $article=Article::whereRaw("id=? and isdelete=0 and active=1",[$id])->first();
         if($article==NULL){
            return redirect($request->url());
       }
             $isAdmin=\DB::table("admin")->where("user_id",$user->id)->count();
          $isClient=\DB::table("clients")->where("user_id",$user->id)->count();
      
       $q = \Auth::user()->id;
        
        $mycomment=new Comment();
         
       $mycomment->article_id=$id;
         
         $thisClient="";
         $thisAdmin="";
        
        if($isClient){
           
            $thisClient=Client::whereRaw("(clients.isdelete=0 and clients.user_id=$q )")->first();
    $mycomment->client_id=$thisClient->id;
            
        }
         
      if($isAdmin){
             
             $thisAdmin=Admin::whereRaw("(isdelete=0 and admin.user_id =$q )")->first();
             
              $mycomment->admin_id=$thisAdmin->id;
         
         }
         
        $mycomment->details=$request["details"];
         $mycomment->isactive=1;
         $mycomment->is_delete=0;
       
        $mycomment->save();
         
         
          $mycomment->comments_id=$mycomment->id;
          
          $mycomment->save();
         
        \Session::flash("msg","s: تم اضافه تعليقك بنجاح");
        return redirect("/cms/comment/$id/all"); 
         
    }
    
}

?>

