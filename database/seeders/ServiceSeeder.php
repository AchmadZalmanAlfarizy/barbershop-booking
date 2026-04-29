<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'Potong Rambut',         'price' => 25000, 'duration' => 30],
            ['name' => 'Cukur Jenggot',          'price' => 20000, 'duration' => 20],
            ['name' => 'Potong + Cukur Jenggot', 'price' => 40000, 'duration' => 45],
            ['name' => 'Cuci Rambut',            'price' => 15000, 'duration' => 15],
            ['name' => 'Potong + Cuci Rambut',   'price' => 35000, 'duration' => 40],
            ['name' => 'Creambath',              'price' => 50000, 'duration' => 60],
        ];

        foreach ($services as $service) {
            Service::create($service + ['is_active' => true]);
        }
    }
}
