<?php

namespace App\Http\Controllers\CMS;

use App\User;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests\AdminRequest;
use App\Admin;


class AdminController extends BaseController
{  
   
    
    public function index(Request $request)
    {
        $q = $request["q"];
        $active = $request["active"];
        $items = Admin::whereRaw("isdelete=0 and (fullname like ?)",["%$q%"]);   
      
        if($active!=""){
            $items->where("active",$active);
        }
        $items=$items->orderby("id","desc")->paginate(10)->appends(["q"=>$q,"active"=>$active]);
        
        return view("cms.admin.index",compact("items","q","active"));
    }    
    public function create()
    {
        return view("cms.admin.create");
    }    
    public function store(AdminRequest $request)
    {
        if($request['password']=="" ||$request['password']==NULL){            
            \Session::flash("msg","e: يجب ادخال كلمة المرور");
            return redirect("/cms/admin/create")->withInput();
        }
        if(Admin::IsExists($request["email"])){
            \Session::flash("msg","w: ".$request["email"]." موجود مسبقا لدينا");
            return redirect("/cms/admin/create")->withInput();
        }
        $isExists=User::where("email",$request["email"])->count()>0;
        if($isExists){
            \Session::flash("msg","w: ".$request["email"]." موجود مسبقا لدينا");
            return redirect("/cms/admin/create")->withInput();
		}
        $user = User::create([
            'name' => $request['fullname'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        //رقم المستخدم الذي تم انشائه
        Admin::Add($request,\Session::get("adminid"),$user->id);
        
        \Session::flash("msg","s: تمت عملية الاضافة بنجاح");
        
        return redirect("/cms/admin/create");//افتح الصفحة من اول وجديد
    }    
    public function destroy($id){
        $admin = Admin::find($id);

        
        Admin::DeleteItem($admin,\Session::get("adminid"));
        
        \Session::flash("msg","s: تمت عملية الحذف بنجاح");
        
        return redirect("/cms/admin");
    }    
    public function edit($id)
    {
        $item=Admin::find($id);
        if($item==NULL){
            \Session::flash("msg","e: الرابط المطلوب غير موجود");
        
            return redirect("/cms/admin");
        }
        return view("cms.admin.edit",compact("item"));
    }    
    public function update(AdminRequest $request,$id)
    {
        /*if(Admin::IsExists($request["email"],$id)){
            \Session::flash("msg","w: ".$request["fullname"]." موجود مسبقا لدينا");
            return redirect("/cms/admin/$id/edit")->withInput();
        }*/
        $admin = Admin::find($id);
        $user_id=$admin->user_id;
        $user=User::find($user_id);
        $user->name=$request["fullname"];
        if(strlen(trim($request["password"]))>0){
            $user->password=bcrypt($request['password']);
        }
        $user->save();
        
        Admin::UpdateItem($request,\Session::get("adminid"),$id);
        
        \Session::flash("msg","s: تمت عملية الحفظ بنجاح");
        
        return redirect("/cms/admin");//افتح الصفحة من اول وجديد
    }        
    
    public function permission($id)
    {
        $item=Admin::find($id);
        if($item==NULL){
            \Session::flash("msg","e: الرابط المطلوب غير موجود");
        
            return redirect("/cms/admin");
        }
        return view("cms.admin.permission",compact("item"));
    } 
    public function setpermission($id,Request $request)
    {
        //echo $id."<br>";
        //var_dump($request["link"]);
        \DB::table("admin_link")->where("admin_id",$id)->delete();
        foreach($request["link"] as $l)
            \DB::table("admin_link")->insert(["admin_id"=>$id,"link_id"=>$l]);
        \Session::flash("msg","s: تمت عملية الحفظ بنجاح");
        return redirect("/cms/admin/$id/permission");
    }
}

?>