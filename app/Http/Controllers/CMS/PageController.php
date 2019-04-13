<?php


namespace App\Http\Controllers\CMS;

use App\User;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests\PageRequest;

use App\Page;


class PageController extends BaseController
{  
    
    public function index(Request $request)
    {
        $q = $request["q"];
        $active = $request["active"];     
        $items = page::whereRaw("isdelete=0 and(title like ? )",["%$q%"]);    
        if($active!="")
            $items->where("active",$active);        
        $items=$items->orderby("id","desc")->paginate(10)->appends(["q"=>$q,"active"=>$active]);
        return view("cms.page.index",compact("items","q","active"));      
    }
    
    public function create()
    {
        return view("cms.page.create");
    }
    
    public function store(PageRequest $request)
    {      
        if(Page::IsExists($request["title"])){
            \Session::flash("msg","w: ".$request["title"]." موجود مسبقا لدينا");
            return redirect("/cms/page/create")->withInput();
        }
        
        $image="";
		if(!$this->UploadImage($request,$image,true))
		{
			return redirect("/cms/slider/create")->withInput();
		}
        Page::Add($request,\Session::get("adminid"),$image);
        
        \Session::flash("msg","s: تمت عملية الاضافة بنجاح");
        
        return redirect("/cms/page/create");//افتح الصفحة من اول وجديد
    }    
    public function destroy($id){
        $item = Page::find($id);
        //$item.isdelete=1;
        Page::DeleteItem($item,\Session::get("adminid"));
        
        \Session::flash("msg","s: تمت عملية الحذف بنجاح");
        
        return redirect("/cms/page");
    }    
    public function edit($id)
    {
        $item=Page::find($id);
        if($item==NULL){
            \Session::flash("msg","e: الرابط المطلوب غير موجود");        
            return redirect("/cms/page");
        }
        return view("cms.page.edit",compact("item"));
    }    
    public function update(PageRequest $request,$id)
    {                
        if(Page::IsExists($request["title"],$id)){
            \Session::flash("msg","w: ".$request["title"]." موجود مسبقا لدينا");
            return redirect("/cms/page/create")->withInput();
        }
        $image="";
		if(!$this->UploadImage($request,$image,false))
		{
			return redirect("/cms/slider/$id/edit")->withInput();
		}
        Page::UpdateItem($request,\Session::get("adminid"),$id,$image);
        
        \Session::flash("msg","s: تمت عملية الحفظ بنجاح");
        
        return redirect("/cms/page");//افتح الصفحة من اول وجديد
    }        
}

?>

