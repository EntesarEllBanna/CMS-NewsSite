<?php

namespace App\Http\Controllers\CMS;

use App\User;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

use App\Comment;
use App\Http\Requests\ArticleRequest;
use App\Category;
use App\Article;

class ArticleController extends BaseController
{  
    
    public function index(Request $request)
    {
        $q = $request["q"];
        $category_id = $request["category_id"];
        $active = $request["active"];
        $categorylist=Category::where("isdelete",0)->get();
        
        $items = Article::whereRaw(" isdelete=0   and  (title like ? or summary like ?)",["%$q%","%$q%"]);
        
        if($category_id!="")
            $items->where("category_id",$category_id);
        
        if($active!="")
            $items->where("active",$active);
        
        $items=$items->orderby("id","desc")->paginate(10)
            ->appends(["q"=>$q,"active"=>$active,"category_id"=>$category_id]);
        return view("cms.article.index",compact("items","q","active","category_id","categorylist"));
    } 
    
    
    
    
    public function create()
    {
        $categorylist=Category::where("isdelete",0)->get();
        return view("cms.article.create",compact("categorylist"));
    }  
    
    
    
    
    public function store(ArticleRequest $request)
    {      
        $image="";
		if(!$this->UploadImage($request,$image,true))
		{
			return redirect("/cms/slider/create")->withInput();
		}
        Article::Add($request,\Session::get("adminid"),$image);
        
        \Session::flash("msg","s: تمت عملية الاضافة بنجاح");
        
        return redirect("/cms/article/create");//افتح الصفحة من اول وجديد
    } 
    
    
    
    
    public function destroy($id){
        $item = Article::find($id);
        
        Article::DeleteItem($item,\Session::get("adminid"));
        
        \Session::flash("msg","s: تمت عملية الحذف بنجاح");
        
        return redirect("/cms/article");
    } 
    
    
    
   
    
    
//    public function allComments(Request $request, $id)
//    {
//      $article = Article::find($id);
//         
//        if($article==NULL){
//            \Session::flash("msg","e: الرابط المطلوب غير موجود");
//        
//            return redirect("/cms/article");
//        }
//      $q = $request["q"]; 
//          $active = $request["active"];
//     
//        $comment =Comment::whereRaw("comments.is_delete=0");
//         $comment =$comment->leftJoin("clients","client_id","clients.id")->whereRaw(" article_id = ?",["$id"] );
//     if ($q!=NULL){
//         
//           
//         $comment=$comment->whereRaw("clients.name like ? or comments.details like ?",["%$q%","%$q%"]);
//         }
//            if($active!="")
//            $comment=$comment->where("isactive",$active);
//       $comment=$comment->paginate(10)->appends(["q"=>$q,"active"=>$active]);
//      return view("cms.article.EveryCommentsForAdmin"
//                  ,compact("comment","q","article","active"));
//     }
//    

    
    public function edit($id)
    {
        $categorylist=Category::where("isdelete",0)->get();
        $item=Article::find($id);
        if($item==NULL){
            \Session::flash("msg","e: الرابط المطلوب غير موجود");
        
            return redirect("/cms/article");
        }
        return view("cms.article.edit",compact("item","categorylist"));
    }   
    
    
    
    
    public function update(ArticleRequest $request,$id)
    {    
        
        $image="";
		if(!$this->UploadImage($request,$image,false))
		{
			return redirect("/cms/slider/$id/edit")->withInput();
		}
        Article::UpdateItem($request,\Session::get("adminid"),$id,$image);
        
        \Session::flash("msg","s: تمت عملية الحفظ بنجاح");
        
        return redirect("/cms/article");//افتح الصفحة من اول وجديد
    }
    
    
    //should be in aspecial commentscontroler related to admin 
     public function active($id)
    {
        $item = Comment::find($id);
         
        if($item==NULL)
            return "Invalid ID";
      
       $item->isactive=!($item->isactive);
        $item->save();
        
        return response()->json([
            'status' => 1,
            'msg' => 's:تمت عملية '.(
                $item->isactive?
                "التفعيل":
                "التعطيل"
            ).' بنجاح'
        ]);
    }
}

?>