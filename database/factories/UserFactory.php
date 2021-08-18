<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->userName(),
            'password' => $this->faker->password(12),
            'name' => $this->faker->firstName(),
            "surname" => $this->faker->lastName(),
            "sex" => (int) $this->faker->boolean(),
            "email" => $this->faker->safeEmail(),
            "profileImage" => $this->faker->text(20) . ".jpg",
            "description" => $this->faker->text(200),
            "location" => $this->faker->text(50),
            "links" => ''
        ];
    }
}
