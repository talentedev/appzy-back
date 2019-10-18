<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'Diet' => new QuizAnswerResource($this->get('Diet')),
            'LifeStyle' => new QuizAnswerResource($this->get('LifeStyle')),
            'Products' => QuizAnswerResource::collection($this->get('Products')),
        ];
    }
}
