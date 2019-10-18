<?php

namespace App\Http\Controllers\Api;

use App\Models\Player;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Http\Resources\ProductResource;
use Unifonic\API\Client;

class PlayerController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        if ($request->token === 'moe') {
            return PlayerResource::collection(
                Player::orderBy('created_at', 'DESC')->paginate()
            );
        }
    }

    public function get(Player $player)
    {
        return new PlayerResource($player);
    }

    public function products(Player $player)
    {
        return ProductResource::collection($player->products->paginate());
    }

    public function store(PlayerRequest $request)
    {
        $player = Player::create([
            'uuid' => (string) Str::uuid(),
            'name' => $request->name,
            'gender' => $request->gender,
            'age' => $request->age,
            'city' => $request->city,
            'mobile' => $request->mobile,
        ]);

        foreach ($request->questions as $questionRequest) {
            $question = $player->questions()->create([
                'title' => $questionRequest['title'],
                'subtitle' => $questionRequest['subtitle'],
            ]);

            foreach ($questionRequest['answers'] as $answerRequest) {
                $answer = $question->answers()->create([
                    'title' => $answerRequest['title'],
                    'subtitle' => $answerRequest['subtitle'],
                    'icon' => $answerRequest['icon'],
                    'tag' => $answerRequest['tag'],
                    'is_selected' => $answerRequest['is_selected'],
                ]);
            }
        }

        $player->load('questions.answers');

        $this->sendSMS([
            'uuid' => $player->uuid,
            'mobile' => $request->mobile,
        ]);

        return new PlayerResource($player);
    }

    protected function sendSMS($config)
    {
        $unifonic = new Client();
        $message = 'يمكنك الوصول إلى نتيجتك من خلال الرابط التالي';
        $message .= config('unifonic.result_url').$config['uuid'];

        $unifonic->Send($config['mobile'], $message, config('unifonic.sender_name'));
    }
}
