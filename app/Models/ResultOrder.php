<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\MetronicPaginate;

class ResultOrder extends Model
{
    //
    use MetronicPaginate;
    public function quiz_user()
    {
        return $this->belongsTo(UserQuiz::class, 'quiz_user_id', 'id');
    }

}
