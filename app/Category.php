<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\CategoryRequest;
class Category extends Model
{
    protected $table="category";    
    
    public static function IsExists($title,$id=0){
        if($id!=0)
            return Category::where("title",$title)->where("isdelete",0)->where("id","!=",$id)->count()>0;
        return Category::where("title",$title)->where("isdelete",0)->count()>0;
    }
    
    public static function Add(CategoryRequest $request, $adminId)
    {
        $category=new Category();
        $category->title=$request["title"];
        $category->active=$request["active"]?1:0;
        $category->created_by=$adminId;
        $category->isdelete=0;
        $category->save();//تم الحفظ
    }
    
    public static function UpdateItem(CategoryRequest $request, $adminId,$id)
    {
        $category=Category::find($id);
        $category->title=$request["title"];
        $category->active=$request["active"]?1:0;
        $category->updated_by=$adminId;
        $category->save();//تم الحفظ
    }
    
    public static function DeleteItem(Category $category, $adminId)
    {
        $category->updated_by=$adminId;
        $category->isdelete=1;
        $category->save();//تم الحفظ
    }
    
    
    public function articles()
    {
        return $this->hasMany('App\Article');        
    }
}
