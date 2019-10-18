<?php

use App\Models\Player;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;

class PlayersTableSeeder extends Seeder
{
    public function run()
    {
        factory(Player::class, 50)->create()->each(function ($player) {
            factory(Question::class, rand(3, 6))->create([ 'player_id' => $player->id ])->each(function ($question) {
                factory(Answer::class, rand(3, 5))->create([ 'question_id' => $question->id ]);
            });
        });
    }
}
