<?php


namespace App\Http\Controllers\CMS;

use App\User;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests\MenuRequest;

use App\Menu;


class MenuController extends BaseController
{  
    
    public function index($id=0)
    {
        $mTitle="";
        if($id!=0){
            $m=Menu::find($id);
            if($m==NULL || $m->is_delete==1){
                \Session::flash("msg","e: الرجاء التاكد من الرابط المرسل");
                return redirect("/cms/menu");
            }
            $mTitle=$m->title;
        }
        //echo $id; die();
        $items = Menu::whereRaw("isdelete=0 and parent_id=?",[$id]);    
        $items=$items->get();
        return view("cms.menu.index",compact("items","id","mTitle"));      
    }
    
    public function create($id=0)
    {
        $mTitle="";
        if($id!=0){
            $m=Menu::find($id);
            if($m==NULL || $m->is_delete==1){
                \Session::flash("msg","e: الرجاء التاكد من الرابط المرسل");
                return redirect("/cms/menu");
            }
            $mTitle=$m->title;
        }
        return view("cms.menu.create",compact("id","mTitle"));
    }
    
    public function store(MenuRequest $request)
    {      
        if(Menu::IsExists($request["title"],$request["parent_id"])){
            \Session::flash("msg","w: ".$request["title"]." موجود مسبقا لدينا");
            return redirect("/cms/menu/create")->withInput();
        }
        $parent_id=$request["parent_id"];
        Menu::Add($request,\Session::get("adminid"));
        
        \Session::flash("msg","s: تمت عملية الاضافة بنجاح");
        
        return redirect("/cms/menu/create/$parent_id");//افتح الصفحة من اول وجديد
    }    
    public function destroy($id){
        
        $item = Menu::find($id);    
        $parent_id=$item->parent_id;
        $childrenCount=Menu::where("isdelete",0)->where("parent_id",$id)->count();
        if($childrenCount>0){
            \Session::flash("msg","w: لا يمكن حذف قائمة تحتوي على عناصر");        
            return redirect("/cms/menu/$parent_id");
        }
        Menu::DeleteItem($item,\Session::get("adminid"));        
        \Session::flash("msg","s: تمت عملية الحذف بنجاح");        
        return redirect("/cms/menu/$parent_id");
    }    
    public function edit($id)
    {
        $mTitle="";
        $item=Menu::find($id);
        if($item==NULL){
            \Session::flash("msg","e: الرابط المطلوب غير موجود");        
            return redirect("/cms/menu");
        }
        $m=Menu::find($item->parent_id);
        if($m!=NULL)
            $mTitle=$m->title;
        return view("cms.menu.edit",compact("item","mTitle"));
    }    
    public function update(MenuRequest $request,$id)
    {                
        if(Menu::IsExists($request["title"],$id)){
            \Session::flash("msg","w: ".$request["title"]." موجود مسبقا لدينا");
            return redirect("/cms/menu/create")->withInput();
        }
        Menu::UpdateItem($request,\Session::get("adminid"),$id);
        $parent_id=$request["parent_id"];
        \Session::flash("msg","s: تمت عملية الحفظ بنجاح");
        
        return redirect("/cms/menu/$parent_id");//افتح الصفحة من اول وجديد
    }
}

?>

