<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\MetronicPaginate;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    //
    use SoftDeletes,MetronicPaginate;
    protected $fillable = [
        'title','content','writer_id' ,'is_featured','image','slug',
    ];
    /* public function getPArabicAttribute(){
        if ($this->is_arabic == "1") {
            return 'Arabic';
        }else {
            return 'English';
        }
    } */

    /* public function getPStatusAttribute(){
        if ($this->status == "P") {
            return 'Pending';
        }elseif($this->status == "A"){
            return 'Approved';
        }else {
            return 'Rejected';
        }
    } */

    public function user(){
        return $this->belongsTo(User::class,'writer_id','id');
    }

    public function Logs(){
        return $this->hasMany(log::class,'article_id','id');
    }

    public function statistics(){
        return $this->hasOne(article_statistics::class)->withDefault(['views' => 0]);
    }

    public function getStatusAttribute($status){
        if ($status == "P") {
            if(App::currentLocale() == "ar"){
                return 'قيد الإنتظار';
            }else{
                return 'Pending';
            }

        }else if ($status == "A") {
            if(App::currentLocale() == "ar"){
                return 'تمت الموافقة';
            }else{
                return 'Approved';
            }

        }else {
            if(App::currentLocale() == "ar"){
                return 'مرفوض';
            }else{
                return 'Rejected';
            }
        }
    }

    public function getIsFeaturedAttribute($status){
        if ($status == 1) { // i.e is_active == true
            if(App::currentLocale() == "ar"){
                return 'مميز';
            }else{
                return 'Featured';
            }

        }else {
            return '-';
            /* if(App::currentLocale() == "ar"){
                return 'غير مميز';
            }else{
                return 'Not featured';
            } */
        }
    }

    public function getIsArabicAttribute($status){
        if ($status == 1) { // i.e is_active == true
            if(App::currentLocale() == "ar"){
                return 'العربية';
            }else{
                return 'Arabic';
            }

        }else {
            if(App::currentLocale() == "ar"){
                return 'الانجليزية';
            }else{
                return 'English';
            }
        }
    }

    public function getImageAttribute($image){

        if($image){
            $image = Storage::url('public/'.$image.'');
           return $image;
        }
    }

    public function getCreatedAtAttribute($var){
        return Carbon::parse($var)->isoFormat('MMMM Do YYYY');
    }

    public function getDeletedAtAttribute($var){
        return Carbon::parse($var)->isoFormat('MMMM Do YYYY');
    }

    public function getUpdatedAtAttribute($var){
        return Carbon::parse($var)->isoFormat('MMMM Do YYYY');
    }

}
