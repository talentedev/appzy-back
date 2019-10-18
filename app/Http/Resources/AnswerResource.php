<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'question' => $this->question->title,
            'is_selected' => $this->is_selected,
        ];
    }
}
