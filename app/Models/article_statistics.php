<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class article_statistics extends Model
{
    //
    protected $guarded =[];

    public function article(){

        return $this->belongsTo(Article::class,'article_id')->withDefault();
    }
}
