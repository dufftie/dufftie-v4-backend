<?php

namespace Database\Factories;

use App\Models\Artwork;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtworkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Artwork::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'title' => $this->faker->text(40),
            'description' => $this->faker->text(40),
            'body' => $this->faker->randomHtml(6, 10),
            'publishDate' => $this->faker->date(),
            'daysSpent' => $this->faker->numberBetween(0, 365),
            'preview' => $this->faker->text(20),
            'bgColor' => $this->faker->hexColor(),
            'isHidden' => 0,
        ];
    }
}
