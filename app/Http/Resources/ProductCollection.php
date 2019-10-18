<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public $collect = 'App\Http\Resources\ProductResource';

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
