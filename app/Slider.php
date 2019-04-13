<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\SliderRequest;

class Slider extends Model
{
    protected $table="slider";    
    
    public static function IsExists($title,$id=0){
        if($id!=0)
            return Slider::where("title",$title)->where("isdelete",0)->where("id","!=",$id)->count()>0;
        return Slider::where("title",$title)->where("isdelete",0)->count()>0;
    }
    
    public static function Add(SliderRequest $request, $adminId,$image)
    {
        $item=new Slider();
        $item->title=$request["title"];    
        $item->summary=$request["summary"];
        $item->image=$image;
        $item->url=$request["url"];
        $item->active=$request["active"]?1:0;
        $item->newwindow=$request["newwindow"]?1:0;
        $item->created_by=$adminId;
        $item->isdelete=0;
        $item->save();//تم الحفظ
    }
    
    public static function UpdateItem(SliderRequest $request, $adminId,$id,$image)
    {
        $item=Slider::find($id);
        $item->title=$request["title"];    
        $item->summary=$request["summary"];
        if($image!="")
            $item->image=$image;
        $item->url=$request["url"];
        $item->active=$request["active"]?1:0;
        $item->newwindow=$request["newwindow"]?1:0;
        $item->created_by=$adminId;
        $item->save();//تم الحفظ
    }
    
    public static function DeleteItem( Slider $item, $adminId)
    {
        $item->updated_by=$adminId;
        $item->isdelete=1;
        $item->save();//تم الحفظ
    }
}
