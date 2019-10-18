<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
            'gender' => [
                'required',
                Rule::in([ 'male', 'female' ]),
            ],
            'age' => [
                'required',
                'integer',
                'min:18',
            ],
            'city' => [
                'required',
            ],
            'mobile' => [
                'required',
            ],
            'questions' => [
                'required',
                'array',
            ],
            'questions.*' => [
                'array',
            ],
            'questions.*.answers' => [
                'required',
                'array',
            ],
            'questions.*.answers.*' => [
                'array',
            ],
        ];
    }
}
