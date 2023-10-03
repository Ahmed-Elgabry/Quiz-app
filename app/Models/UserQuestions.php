<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UserQuestions extends Model
{
    //
    public function quiz(){
        return $this->belongsTo(UserQuiz::class,'quiz_id','id');
    }

    public function options(){
        return $this->hasMany(UserOptions::class,'question_id','id');
    }

    public function getQuestionImgAttribute($image){
        if($image){
            $image = Storage::url('public/'.$image.'');
           return $image;
        }
    }
}
