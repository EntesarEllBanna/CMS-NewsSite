<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table="comments";
	public function article()
    {
        return $this->belongsTo("App\Article");
    }
	public function client()
    {
        return $this->belongsTo("App\Client");
    }
    
    public function admin()
    {
        return $this->belongsTo("App\Admin");
    }
}
