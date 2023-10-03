<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    //
    protected $table    = 'settings';
	protected $fillable = [
		'sitename_ar',
		'sitename_en',
		'logo',
		'email',
		'description_ar',
		'description_en',
		'mobile',
		'facebook',
		'twitter',
		'snapshat',
	];
}
