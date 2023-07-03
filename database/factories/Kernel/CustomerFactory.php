<?php

namespace Database\Factories\Kernel;

use App\Modules\Kernel\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Modules\Kernel\Enums\Customer\CustomerCreatedBy;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'name' => $this->faker->name,
            'created_by' => $this->faker->randomElement(CustomerCreatedBy::cases())
        ];
    }
}
