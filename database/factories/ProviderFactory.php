<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Provider>
 */
class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'company_id' => Company::factory(),
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
