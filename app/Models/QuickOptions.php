<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuickOptions extends Model
{
    use HasFactory;

    public function question(){
        return $this->belongsTo(QuickQuestions::class,'question_id','id');
    }
}
