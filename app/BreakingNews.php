<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\BreakingNewsRequest;

class BreakingNews extends Model
{
    protected $table="breakingnews";   
    
    
    
    public static function Add(BreakingNewsRequest $request, $adminId)
    {
        $item=new BreakingNews();
        $item->news=$request["news"];
        $item->period=$request["period"];
        $item->expiredate=date("Y/m/d H:i:s", strtotime("+$item->period minutes"));
        $item->created_by=$adminId;
        $item->isdelete=0;
        $item->save();//تم الحفظ
    }
    
    public static function UpdateItem(BreakingNewsRequest $request, $adminId,$id)
    {
        $item=BreakingNews::find($id);
        $item->news=$request["news"];
        $item->period=$request["period"];
        $item->expiredate=date("Y/m/d H:i:s", strtotime("+$item->period minutes"));
        $item->updated_by=$adminId;
        $item->save();//تم الحفظ
    }
    
    public static function DeleteItem(BreakingNewsRequest $item, $adminId)
    {
        $item->updated_by=$adminId;
        $item->isdelete=1;
        $item->save();//تم الحفظ
    }
}
