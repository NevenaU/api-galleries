<?php

namespace Database\Factories;

use App\Models\Gallery;
use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    public function definition()
    {
        $userId = User::all()->pluck('id')->toArray();
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->text($maxNbChars = 1000),
            'user_id' => $this->faker->randomElement($userId)
            
        ];
    }
}


