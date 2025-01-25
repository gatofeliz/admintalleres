<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceOrderFactory>
 */
class ServiceOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => '005992',
            'date' => '11/01/2025',
            'imei' => '356303483084057',
            'turn_on' => true,
            'blows' => true,
            'tactile' => false,
            'cargo_port' => false,
            'colour' => '#000000',
            'password' => 'comoquepassword',
            'failure' => 'BISAGRAS QUEBRADAS, NO DA VIDEO, COTIZAR SERVICIO, DEJA CARGADOR',
            'diagnosis' => 'BISAGRAS QUEBRADAS, NO DA VIDEO, COTIZAR SERVICIO, DEJA CARGADOR',
            'budget' => 10000,
            'repair' => 5000,
            'advance' => 0,
            'total' => 15000,
        ];
    }
}
