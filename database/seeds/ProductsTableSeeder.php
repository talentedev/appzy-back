<?php

use App\Models\Tag;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::all();

        $limit = (int) round($tags->count()/2);

        factory(Product::class, 50)->create()->each(function ($product) use ($limit) {

            $tags = Tag::inRandomOrder()->limit($limit)->get();

            $product->tags()->attach($tags->pluck('id'));
        });
    }
}
