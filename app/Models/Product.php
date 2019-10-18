<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'link',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeTagged($query, $tags)
    {
        return $query->whereHas('tags', function ($q) use ($tags) {
            foreach ($tags as $tag) {
                $q->where('name', $tag);
            }
        });
    }

    public static function queryTags($tags)
    {
        $products = Product::tagged($tags)->get();

        if (count($tags) > 1) {
            foreach ($tags as $tag) {
                $refinedTags = $tags->filter(function ($value) use ($tag) {
                    return $value !== $tag;
                });

                $products = $products->concat(
                    static::queryTags($refinedTags)
                );
            }
        }

        return $products;
    }

    public static function queryWeightedTags($weightedTags)
    {
        $products = collect();

        foreach ($weightedTags as $tags) {
            $products = $products->concat(static::queryTags($tags));
        }

        return $products;
    }
}
