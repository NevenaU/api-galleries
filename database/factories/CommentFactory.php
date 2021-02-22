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
        return [
            'content'=>$this->faker->sentence(),
            'gallery_id'=>function(){
                return Gallery::all()->random()->id;
            },
            'user_id'=>function(){
                return User::all()->random()->id;
            }
        ];
    }
}
