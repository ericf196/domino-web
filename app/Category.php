<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name_category',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'games','category_id','user_id')->withPivot('jj', 'jg', 'jp', 'pts_p', 'pts_n', 'avg', 'efec', 'pro', 'z', 'pro_g' , 'season')->wherePivot('season', Carbon::now()->year);
    }

    public function leagues()
    {
        return $this->belongsToMany(League::class)->withPivot('created_at', 'updated_at');
    }

    public function users_individual()
    {
        return $this->belongsToMany(User::class, 'games_individual','category_id','user_id')->withPivot('jj','jg','jp','pts_p','pts_n','avg','efec','pro', 'z', 'pro_g' ,'created_at');
    }
}
