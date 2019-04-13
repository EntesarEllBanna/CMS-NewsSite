<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\PageRequest;

class Page extends Model
{
    protected $table="page";    
    
    public static function IsExists($title,$id=0){
        if($id!=0)
            return page::where("title",$title)->where("isdelete",0)->where("id","!=",$id)->count()>0;
        return page::where("title",$title)->where("isdelete",0)->count()>0;
    }
    public static function Add(PageRequest $request, $adminId,$image)
    {
        $item=new Page();
        $item->title=$request["title"];    
        $item->details=$request["details"];
        $item->image=$image;
        $item->active=$request["active"]?1:0;
        $item->created_by=$adminId;
        $item->isdelete=0;
        $item->save();//تم الحفظ
    }
    
    public static function UpdateItem(PageRequest $request, $adminId,$id,$image)
    {
        $item=Page::find($id);
        $item->title=$request["title"];       
        $item->details=$request["details"];
        $item->image=$image;
        $item->active=$request["active"]?1:0;
        $item->updated_by=$adminId;
        $item->save();//تم الحفظ
    }
    
    public static function DeleteItem( Page $item, $adminId)
    {
        $item->updated_by=$adminId;
        $item->isdelete=1;
        $item->save();//تم الحفظ
    }
}
