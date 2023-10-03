<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\MetronicPaginate;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

/* class User extends Authenticatable implements MustVerifyEmail{ */
class User extends Authenticatable
{
    use Notifiable,SoftDeletes,MetronicPaginate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /* protected $appends = ['email']; */

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /* protected $casts = [
        'email_verified_at' => 'datetime',
    ]; */

    public function user_quizzes(){
        return $this->hasMany(UserQuiz::class,'user_id','id');
    }

    public function Articles(){
        return $this->hasMany(Article::class,'writer_id','id');
    }

    public function Logs(){
        return $this->hasMany(log::class,'user_id','id');
    }


    /* public function getPisEditorAttribute(){
        if ($this->is_editor == "1") {
            return 'Editor';
        }else {
            return '-';
        }
    } */

    public function getCreatedAtAttribute($var){
        return Carbon::parse($var)->isoFormat('MMMM Do YYYY');
    }

    public function getDeletedAtAttribute($var){
        return Carbon::parse($var)->isoFormat('MMMM Do YYYY');
    }

    public function getIsEditorAttribute($status){
        if ($status == 1) { // i.e is_active == true
            if(App::currentLocale() == "ar"){
                return 'محرر';
            }else{
                return 'Editor';
            }

        }else {
            if(App::currentLocale() == "ar"){
                return 'مستخدم';
            }else{
                return 'User';
            }
        }
    }
}
