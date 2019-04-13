<?php

namespace App\Http\Controllers\CMS;

use App\User;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests\CategoryRequest;
use App\Category;

class CategoryController extends BaseController
{  
    
    public function index(Request $request)
    {
        $q = $request["q"];
        $items = Category::whereRaw("isdelete=0 and (title like ?)",["%$q%"]);   
        $items=$items->paginate(10)->appends(["q"=>$q]);
        return view("cms.category.index",compact("items","q"));
    }    
    public function create()
    {
        return view("cms.category.create");
    }    
    public function store(CategoryRequest $request)
    {
        if(Category::IsExists($request["title"])){
            \Session::flash("msg","w: ".$request["title"]." موجود مسبقا لدينا");
            return redirect("/cms/category/create")->withInput();
        }
        
        Category::Add($request,\Session::get("adminid"));
        
        \Session::flash("msg","s: تمت عملية الاضافة بنجاح");
        
        return redirect("/cms/category/create");//افتح الصفحة من اول وجديد
    }    
    public function destroy($id){
        $category = Category::find($id);
        if($category->articles()->count()>0){
            \Session::flash("msg","w: لا يمكن حذف التصنيف لوجود أخبار به");
            return redirect("/cms/category");
        }
        
        Category::DeleteItem($category,\Session::get("adminid"));
        
        \Session::flash("msg","s: تمت عملية الحذف بنجاح");
        
        return redirect("/cms/category");
    }    
    public function edit($id)
    {
        $item=Category::find($id);
        if($item==NULL){
            \Session::flash("msg","e: الرابط المطلوب غير موجود");
        
            return redirect("/cms/category");
        }
        return view("cms.category.edit",compact("item"));
    }    
    public function update(CategoryRequest $request,$id)
    {
        if(Category::IsExists($request["title"],$id)){
            \Session::flash("msg","w: ".$request["title"]." موجود مسبقا لدينا");
            return redirect("/cms/category/$id/edit")->withInput();
        }
        
        Category::UpdateItem($request,\Session::get("adminid"),$id);
        
        \Session::flash("msg","s: تمت عملية الحفظ بنجاح");
        
        return redirect("/cms/category");//افتح الصفحة من اول وجديد
    }    
}
?>