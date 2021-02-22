<?php

namespace Database\Factories;

use App\Models\Gallery;
use App\Models\Image;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $galeryId = Gallery::all()->pluck('id')->toArray();
        return [
            'url' => $this->faker->imageUrl($width = 640, $height = 480),
            'gallery_id'=>$this->faker->randomElement($galeryId),
        ];
    }
}
