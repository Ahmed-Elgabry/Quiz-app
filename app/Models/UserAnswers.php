<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\MetronicPaginate;
use Carbon\Carbon;

class UserAnswers extends Model
{
    //

    use MetronicPaginate;

    public function quiz(){
        return $this->belongsTo(UserQuiz::class,'quiz_id','id');
    }

    public function getCreatedAtAttribute($var){
        return Carbon::parse($var)->isoFormat('MMMM Do YYYY');
    }
}
