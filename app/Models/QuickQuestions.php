<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class QuickQuestions extends Model
{
    use HasFactory;

    public function quiz(){
        return $this->belongsTo(QuickQuiz::class,'quiz_id','id');
    }

    public function options(){
        return $this->hasMany(QuickOptions::class,'question_id','id');
    }


    public function getQuestionImgAttribute($image){
        if($image){
            $image = Storage::url('public/'.$image.'');
           return $image;
        }
    }
}
