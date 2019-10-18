<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class QuizAnswerCollection extends ResourceCollection
{
    public $collect = 'App\Http\Resources\QuizAnswerResource';

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
