<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MetronicPaginate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class QuickQuiz extends Model
{
    use HasFactory;
    use MetronicPaginate;

    protected $appends = ['quiz_img'];

    public function getQuizImgAttribute()
    {
        return Storage::url('public/'.Settings::first()->logo.'');
    }


    public function getCreatedAtAttribute($var)
    {
        return Carbon::parse($var)->isoFormat('MMMM Do YYYY');
    }

    public function Category()
    {
        return $this->belongsTo(CategoryQuiz::class, 'category', 'id')->withDefault(['id' => 0, 'name' => __('Uncategorized'),]);
    }

    public function questions()
    {
        return $this->hasMany(QuickQuestions::class, 'quiz_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(QuickAnswers::class, 'quiz_id', 'id');
    }

    public function getLangAttribute($status)
    {
        if ($status == "non") {
            return '';
        } elseif ($status == "ar") {
            return __('Arabic');
        } else {
            return  __('English');
        }
    }
}
