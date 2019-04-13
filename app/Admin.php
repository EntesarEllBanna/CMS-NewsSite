<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\AdminRequest;
class Admin extends Model
{
    protected $table="admin";    
    
    public static function IsExists($email,$id=0){
        if($id!=0)
            return Admin::where("email",$email)->where("isdelete",0)->where("id","!=",$id)->count()>0;
        return Admin::where("email",$email)->where("isdelete",0)->count()>0;
    }
    
    public static function Add(AdminRequest $request, $adminId,$user_id)
    {
        $admin=new Admin();
        $admin->fullname=$request["fullname"];
        $admin->email=$request["email"];
        $admin->active=$request["active"]?1:0;
        $admin->created_by=$adminId;
        $admin->user_id=$user_id;
        $admin->isdelete=0;
        $admin->save();//تم الحفظ
    }
    
    public static function UpdateItem(AdminRequest $request, $adminId,$id)
    {
        $admin=Admin::find($id);
        $admin->fullname=$request["fullname"];
        //$admin->email=$request["email"];
        $admin->active=$request["active"]?1:0;
        $admin->updated_by=$adminId;
        $admin->save();//تم الحفظ
    }
    
    public static function DeleteItem(Admin $admin, $adminId)
    {
        $admin->updated_by=$adminId;
        $admin->isdelete=1;
        $admin->save();//تم الحفظ
    }
    

}
