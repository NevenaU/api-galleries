<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userId = User::all()->pluck('id')->toArray();
        $galeryId = Gallery::all()->pluck('id')->toArray();
        return [
            'content'=>$this->faker->sentence(),
            'gallery_id'=>$this->faker->randomElement($galeryId),
            'user_id'=>$this->faker->randomElement($userId)
        ];
    }
}

    