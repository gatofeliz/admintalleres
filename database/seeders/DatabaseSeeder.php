<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\TypeEquipment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tech = \App\Models\User::factory()->create([
            'name' => 'Técnico Ramirez',
            'email' => 'test@test.com',
        ]);

        $customer = \App\Models\Customer::factory()->create([
            'document' => '¿URL?',
            'telephone' => '3231065172',
            'name' => 'Yareli Ramirez',
            'address' => 'Calle LSD #333 Colonia el Mundo',
        ]);

        $brand = \App\Models\Brand::factory()->create([
            'brand' => 'Asus'
        ]);

        $model = \App\Models\Models::factory()->create([
            'model' => 'N50G'
        ]);

        $type = TypeEquipment::factory()->create([
            'type_of_equipment' => 'Laptop'
        ]);

        \App\Models\ServiceOrder::factory()->create([
            'code' => '005992',
            'date' => '11/01/2025',
            'responsibleTechnicial_id' => $tech->id,
            'customer_id' => $customer->id,
            'imei' => '356303483084057',
            'brand_id' => $brand->id,
            'model_id' => $model->id,
            'type_of_equipment_id' => $type->id,
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
            'photos' => '',
        ]);

        $admin = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'admin',
        ]);
    }
}
