<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductTagCollection extends ResourceCollection
{
    public $collect = 'App\Http\Resources\ProductTagResource';

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
