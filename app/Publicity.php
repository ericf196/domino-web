<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicity extends Model
{
    protected $fillable = [
        'name', 'url_publicity', 'league_id', 'status',
    ];

    public function league()
    {
        return $this->belongsTo(League::class);
    }

}
