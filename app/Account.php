<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //اعطيناه اسم الجدول المعنين فيه
    protected $table="account";
    
    
    public function country()
    {
        //ربطهم ما بيشم على ضهر ايده
        //account has country_id column
        //there is country table with id primary key
        return $this->belongsTo('App\Country');
        //return $this->belongsTo('App\Country',"country1_id","id");
        
    }
}
