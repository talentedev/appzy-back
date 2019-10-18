<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->tags() as $tag) {
            if (!Tag::where('name', '=', $tag)->exists()) {
                Tag::create([ 'name' => $tag ]);
            }
        }
    }

    protected function tags()
    {
        return [
            'Pain',
            'Energy',
            'Sleep',
            'Health',
        ];
    }
}
