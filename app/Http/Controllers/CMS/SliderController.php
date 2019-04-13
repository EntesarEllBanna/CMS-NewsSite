<?php


namespace App\Http\Controllers\CMS;

use App\User;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests\SliderRequest;

use App\Slider;


class SliderController extends BaseController
{  
    
    public function index(Request $request)
    {
        $q = $request["q"];
        $active = $request["active"];     
        $items = Slider::whereRaw("isdelete=0 and(title like ? )",["%$q%"]);    
        if($active!="")
            $items->where("active",$active);        
        $items=$items->orderby("id","desc")->paginate(10)->appends(["q"=>$q,"active"=>$active]);
        return view("cms.slider.index",compact("items","q","active"));      
    }
    
    public function create()
    {
        return view("cms.slider.create");
    }
    
    public function store(SliderRequest $request)
    {      
        if(Slider::IsExists($request["title"])){
            \Session::flash("msg","w: ".$request["title"]." موجود مسبقا لدينا");
            return redirect("/cms/slider/create")->withInput();
        }
        $image="";
		if(!$this->UploadImage($request,$image,true))
		{
			return redirect("/cms/slider/create")->withInput();
		}
        Slider::Add($request,\Session::get("adminid"),$image);
        
        \Session::flash("msg","s: تمت عملية الاضافة بنجاح");
        
        return redirect("/cms/slider/create");//افتح الصفحة من اول وجديد
    }    
    public function destroy($id){
        $item = Slider::find($id);
        
        Slider::DeleteItem($item,\Session::get("adminid"));
        
        \Session::flash("msg","s: تمت عملية الحذف بنجاح");
        
        return redirect("/cms/slider");
    }    
    public function edit($id)
    {
        $item=Slider::find($id);
        if($item==NULL){
            \Session::flash("msg","e: الرابط المطلوب غير موجود");        
            return redirect("/cms/slider");
        }
        return view("cms.slider.edit",compact("item"));
    }    
    public function update(SliderRequest $request,$id)
    {                
        if(Slider::IsExists($request["title"],$id)){
            \Session::flash("msg","w: ".$request["title"]." موجود مسبقا لدينا");
            return redirect("/cms/slider/create")->withInput();
        }
        $image="";
		if(!$this->UploadImage($request,$image,false))
		{
			return redirect("/cms/slider/$id/edit")->withInput();
		}
        Slider::UpdateItem($request,\Session::get("adminid"),$id,$image);
        
        \Session::flash("msg","s: تمت عملية الحفظ بنجاح");
        
        return redirect("/cms/slider");//افتح الصفحة من اول وجديد
    }        
}

?>

