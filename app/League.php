<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_league', 'description', 'state', 'city', 'address', 'name_admin','email','phone','user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot('created_at', 'updated_at');
    }

    public function players()
    {
        return $this->hasMany(User::class);
    }
    public function publicities()
    {
        return $this->hasMany(Publicity::class);
    }

}
