<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MetronicPaginate;
use Carbon\Carbon;

class QuickAnswers extends Model
{
    use HasFactory;
    use MetronicPaginate;

    public function quiz(){
        return $this->belongsTo(QuickQuiz::class,'quiz_id','id');
    }

    public function getCreatedAtAttribute($var){
        return Carbon::parse($var)->isoFormat('MMMM Do YYYY');
    }
}
