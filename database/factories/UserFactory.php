<?php

namespace Database\Factories;

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
        $name = faker()->name;

        return [
            'id' => faker()->uuid(),
            'name' => $name,
            'is_admin' => $this->faker->boolean(),
            'token' => Crypt::encrypt($name),
        ];
    }
}
