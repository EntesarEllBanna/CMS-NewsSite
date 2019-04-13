<?php

namespace App\Http\Controllers\CMS;

use App\User;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests\BreakingNewsRequest;

use App\BreakingNews;
class BreakingNewsController extends BaseController
{  
    
   public function index(Request $request)
    {
        $q = $request["q"];
        $items =BreakingNews::whereRaw("isdelete=0 and (news like ?)",["%$q%"]);
        $items=$items->orderby("id","desc")->paginate(10)->appends(["q"=>$q]);
      
        return view("cms.breakingnews.index",compact("items","q"));
   }
    public function create()
    {
        return view("cms.breakingnews.create");
    }    
    
    public function store(BreakingNewsRequest $request)
    {      
        BreakingNews::Add($request,\Session::get("adminid"));
        
        \Session::flash("msg","s: تمت عملية الاضافة بنجاح");
        
        return redirect("/cms/breakingnews/create");//افتح الصفحة من اول وجديد
    }    
    public function destroy($id){
        $item = BreakingNews::find($id);
         $item->isdelete=1;
         $item->save();
//        BreakingNews::DeleteItem($item,\Session::get("adminid"));

        \Session::flash("msg","s: تمت عملية الحذف بنجاح");
        
        return redirect("/cms/breakingnews");
        
        
        
    }    
    public function edit($id)
    {
        
        $item=BreakingNews::find($id);
        if($item==NULL){
            \Session::flash("msg","e: الرابط المطلوب غير موجود");
        
            return redirect("/cms/breakingnews");
        }
        return view("cms.breakingnews.edit",compact("item"));
    }    
    public function update(BreakingNewsRequest $request,$id)
    {        
        BreakingNews::UpdateItem($request,\Session::get("adminid"),$id);
        
        \Session::flash("msg","s: تمت عملية الحفظ بنجاح");
        
        return redirect("/cms/breakingnews");//افتح الصفحة من اول وجديد
    }        
}
?>