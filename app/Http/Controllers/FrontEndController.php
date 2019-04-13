<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Article;

class FrontEndController extends Controller
{
    public function index()
    {
        $sliders=\DB::table("slider")->whereRaw("active=1 and isdelete=0 limit 5")->get();
        
        $articles=\DB::table("article")->whereRaw("active=1 and isdelete=0 order by id desc limit 8")->get();
        return view('frontend.index',compact("sliders","articles"));
    }
    public function articles(Request $request)
    {
        $q = $request["q"];
        $id = $request["id"];
        $categorylist=Category::where("isdelete",0)->get();
        
        $items = Article::whereRaw("isdelete=0 and active=1 and (title like ? or summary like ?)",["%$q%","%$q%"]);
        
        if($id!="")
            $items->where("category_id",$id);
        
        
        $items=$items->orderby("id","desc")->paginate(12)->appends(["q"=>$q,"id"=>$id]);
        return view("frontend.articles",compact("items","q","id","categorylist"));
    }   
    public function article($id)
    {
        $item=\DB::table("article")->where("article.id",$id)->where("isdelete",0)->where("active",1)->first();
        if($item==NULL){
            \Session::flash("msg","الرابط المطلوب غير موجود");
        
            return redirect("/");
        }
    
        $articles=\DB::table("article")->whereRaw("active=1 and isdelete=0 and category_id=$item->category_id and id!=$id order by id desc limit 8")->get();
        $category=\DB::table("category")->find($item->category_id)->title;
        return view('frontend.article',compact("item","articles","category"));
    }
    public function page($id)
    {
        $item=\DB::table("page")->where("id",$id)->where("isdelete",0)->where("active",1)->first();
        if($item==NULL){
            \Session::flash("msg","الرابط المطلوب غير موجود");
        
            return redirect("/");
        }
        return view('frontend.page',compact("item"));
    }
}
