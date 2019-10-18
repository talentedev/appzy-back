<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'player_id',
        'title',
        'subtitle',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
