<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\MetronicPaginate;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class UserQuiz extends Model
{
    //
    use MetronicPaginate;

    public function getCreatedAtAttribute($var){
        return Carbon::parse($var)->isoFormat('MMMM Do YYYY');
    }

    public function getQuizImgAttribute($image){
        if($image){
            $image = Storage::url('public/'.$image.'');
           return $image;
        }
    }

    public function getIsPrivateAttribute($status){
        if ($status == "1") {
            if(App::currentLocale() == "ar"){
                return 'مخفي';
            }else{
                return 'Private';
            }
        }else {
            if(App::currentLocale() == "ar"){
                return 'عام';
            }else{
                return 'Public';
            }
        }
    }


    public function getResultsShareAttribute($status){
        if ($status == "1") {
            if(App::currentLocale() == "ar"){
                return 'مشاركة';
            }else{
                return 'Shared';
            }
        }else {
            if(App::currentLocale() == "ar"){
                return 'محظورة';
            }else{
                return 'Blocked';
            }
        }
    }

    public function getHideResultAttribute($status){
        if ($status == "1") {
            if(App::currentLocale() == "ar"){
                return 'مخفية';
            }else{
                return 'Hidden';
            }
        }else {
            if(App::currentLocale() == "ar"){
                return 'ظاهرة';
            }else{
                return 'Unhidden';
            }
        }
    }

    public function getHideResultCounterAttribute($status){
        if ($status == "1") {
            if(App::currentLocale() == "ar"){
                return 'مقفل';
            }else{
                return 'Locked';
            }
        }else {
            if(App::currentLocale() == "ar"){
                return 'مفعل';
            }else{
                return 'Activated';
            }
        }
    }

    public function questions(){
        return $this->hasMany(UserQuestions::class,'quiz_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function answers(){
        return $this->hasMany(UserAnswers::class,'quiz_id','id');
    }

    public function ResultOrder(){
        return $this->hasMany(ResultOrder::class,'quiz_user_id','id');
    }

    public function Category(){
        return $this->belongsTo(CategoryQuiz::class,'category','id')->withDefault(['id' => 0, 'name' => __('Uncategorized'),]);
    }

    public function getLangAttribute($status){
        if ($status == "non") {
            return '';
        }elseif ($status == "ar") {
            return __('Arabic');
        }
        else {
            return  __('English');
        }
    }

}
