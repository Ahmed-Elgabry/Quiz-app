<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UserOptions extends Model
{
    //
    public function question(){
        return $this->belongsTo(UserQuestions::class,'question_id','id');
    }

    public function getOptionImgAttribute($image){
        if($image){
            $image = Storage::url('public/'.$image.'');
           return $image;
        }
    }
}
