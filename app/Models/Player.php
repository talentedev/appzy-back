<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'gender',
        'age',
        'city',
        'mobile',
    ];

    protected $casts = [
        'age' => 'integer',
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasManyThrough(Answer::class, Question::class);
    }

    public function getQuizAttribute()
    {
        $products = $this->answers()->whereIn('tag', Tag::all()->pluck('name'))->get()->groupBy->tag;

        $quiz = $this->answers()->whereIn('tag', [ 'LifeStyle', 'Diet' ])->get()->groupBy->tag;

        $mapAnswers = function ($quiz) {
            $answers = $quiz;

            $result = number_format(
                (float) $answers->filter(function ($answer) { return $answer->is_selected; })->count() / $answers->count(),
                2
            );

            $products = $quiz->except([ 'LifeStyle', 'Diet' ]);

            $quiz = new \stdClass;
            $quiz->answers = $answers;
            $quiz->result = (float) $result;

            return $quiz;
        };

        $quiz = $quiz->map($mapAnswers);

        $quiz = $quiz->put(
            'Products',
            $products->map($mapAnswers)->sortByDesc('result')
        );

        return $quiz->sortByDesc('result');
    }

    public function getProductTagsAttribute()
    {
        return $this->quiz->get('Products')->where('result', '<>', 0)->map(function ($item, $key) {
            $data = new \stdClass;
            $data->tag = $key;
            $data->result = $item->result;
            return $data;
        })->groupBy(function ($tag) {
            return (string) $tag->result;
        })->map(function ($group) {
            return $group->map(function ($item) {
                return $item->tag;
            });
        });
    }

    public function getProductsAttribute()
    {
        return Product::queryWeightedTags($this->product_tags);
    }
}
