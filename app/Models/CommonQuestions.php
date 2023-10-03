<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\MetronicPaginate;
use Illuminate\Support\Facades\App;

class CommonQuestions extends Model
{
    //
    use MetronicPaginate;
    /* public function getPArabicAttribute(){
        if ($this->is_arabic == "1") {
            return 'Arabic';
        }else {
            return 'English';
        }
    } */

    public function getIsArabicAttribute($status){
        if ($status == 1) { 
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

}
