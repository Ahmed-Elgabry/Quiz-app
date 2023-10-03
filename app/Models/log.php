<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class log extends Model
{
    //
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function article(){
        return $this->belongsTo(Article::class,'article_id','id');
    }
}
