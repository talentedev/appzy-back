<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AnswerCollection extends ResourceCollection
{
    public $collect = 'App\Http\Resources\AnswerResource';

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
