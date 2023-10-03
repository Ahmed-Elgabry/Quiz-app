<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\MetronicPaginate;
use Carbon\Carbon;

class CategoryQuiz extends Model
{
    //
    use MetronicPaginate;

    public function user_quiz(){
        return $this->hasMany(UserQuiz::class,'category ','id');
    }

    public function quick_quiz(){
        return $this->hasMany(QuickQuiz::class,'category ','id');
    }

    public function getLangAttribute($status){
        if ($status == "ar") {
            return __('Arabic');
        }
        else {
            return  __('English');
        }
    }

    public function getCreatedAtAttribute($var){
        return Carbon::parse($var)->isoFormat('MMMM Do YYYY');
    }
}
