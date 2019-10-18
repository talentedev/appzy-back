<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'question_id',
        'title',
        'subtitle',
        'icon',
        'tag',
        'is_selected',
    ];

    protected $casts = [
        'is_selected' => 'boolean',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
