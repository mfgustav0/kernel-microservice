<?php

namespace Database\Factories\Modules\Application\Models;

use Illuminate\Support\Facades\Crypt;
use App\Modules\Application\Models\User;
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
        $name = $this->faker->name;

        return [
            'id' => $this->faker->uuid(),
            'name' => $name,
            'is_admin' => $this->faker->boolean(),
            'token' => Crypt::encrypt($name),
        ];
    }
}
