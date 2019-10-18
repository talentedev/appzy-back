<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'UserInfo' => [
                'uuid' => $this->uuid,
                'name' => $this->name,
                'gender' => $this->gender,
                'age' => $this->age,
                'city' => $this->city,
                'mobile' => $this->mobile,
                'created_at' => $this->created_at->format('Y-m-d h:m:s (T)'),
            ],
            'Quiz' => new QuizResource($this->quiz),
        ];
    }
}
