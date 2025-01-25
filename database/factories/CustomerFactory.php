<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'document' => '¿URL?',
            'telephone' => '3231065172',
            'name' => 'Yareli Ramirez',
            'address' => 'Calle LSD #333 Colonia el Mundo',
        ];
    }
}
