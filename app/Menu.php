<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\MenuRequest;

class Menu extends Model
{
    protected $table="menu";        
    public static function IsExists($title,$parent_id,$id=0){
        if($id!=0)
            return Menu::where("title",$title)->where("isdelete",0)->where("parent_id",$parent_id)->where("id","!=",$id)->count()>0;
        return Menu::where("title",$title)->where("isdelete",0)->where("parent_id",$parent_id)->count()>0;
    }    
    public static function Add(MenuRequest $request, $adminId)
    {
        $item=new Menu();
        $item->title=$request["title"];    
        $item->parent_id=$request["parent_id"];
        $item->url=$request["url"];
        $item->active=$request["active"]?1:0;
        $item->newwindow=$request["newwindow"]?1:0;
        $item->created_by=$adminId;
        $item->isdelete=0;
        $item->save();//تم الحفظ
    }    
    public static function UpdateItem(MenuRequest $request, $adminId,$id)
    {
        $item=Menu::find($id);
        $item->title=$request["title"];    
        $item->url=$request["url"];
        $item->active=$request["active"]?1:0;
        $item->newwindow=$request["newwindow"]?1:0;
        $item->created_by=$adminId;
        $item->save();//تم الحفظ
    }
    
    public static function DeleteItem( Menu $item, $adminId)
    {
        $item->updated_by=$adminId;
        $item->isdelete=1;
        $item->save();//تم الحفظ
    }
}
