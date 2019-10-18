<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizAnswerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'answers' => AnswerResource::collection($this->answers),
            'result' => $this->result,
        ];
    }
}
