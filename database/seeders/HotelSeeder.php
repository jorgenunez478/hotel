<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\Room;

class HotelSeeder extends Seeder
{
    public function run()
    {
        $hotel = Hotel::create([
            'name' => 'Hotel Example',
            'tax_id' => '123456789',
            'city' => 'Example City',
            'address' => '123 Example Street',
            'nit' => '987654321',
            'max_rooms' => 42,
        ]);

        $hotel->rooms()->createMany([
            ['type' => 'Estándar', 'accommodation' => 'Sencilla', 'quantity' => 25],
            ['type' => 'Junior', 'accommodation' => 'Triple', 'quantity' => 12],
            ['type' => 'Estándar', 'accommodation' => 'Doble', 'quantity' => 5],
        ]);
    }
}