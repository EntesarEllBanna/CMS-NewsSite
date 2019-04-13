<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\ArticleRequest;

class Article extends Model
{
    protected $table="article";    
    
    public function category()
    {
        return $this->belongsTo('App\Category');        
    }
    
    public static function Add(ArticleRequest $request, $adminId,$image)
    {
        $item=new Article();
        $item->title=$request["title"];
        $item->category_id=$request["category_id"];
        $item->summary=$request["summary"];
        $item->details=$request["details"];
        $item->image=$image;
        $item->active=$request["active"]?1:0;
        $item->created_by=$adminId;
        $item->isdelete=0;
        $item->save();//تم الحفظ
    }
    
    public static function UpdateItem(ArticleRequest $request, $adminId,$id,$image)
    {
        $item=Article::find($id);
        $item->title=$request["title"];
        $item->category_id=$request["category_id"];
        $item->summary=$request["summary"];
        $item->details=$request["details"];
        $item->image=$image;
        $item->active=$request["active"]?1:0;
        $item->updated_by=$adminId;
        $item->save();//تم الحفظ
    }
    
    public static function DeleteItem(Article $item, $adminId)
    {
        $item->updated_by=$adminId;
        $item->isdelete=1;
        $item->save();//تم الحفظ
    }
}
