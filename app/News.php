<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title', 'description', 'url_image', 'league_id',
    ];

    public function league()
    {
        return $this->belongsTo(League::class);
    }


}
