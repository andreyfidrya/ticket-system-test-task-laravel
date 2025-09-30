<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'name' => 'ООО "Альфа"',
            'email' => 'contact@alfa.com',
            'phone' => '+380501112233',
        ]);

        Customer::create([
            'name' => 'ЧП "Бета"',
            'email' => 'info@beta.com',
            'phone' => '+380671234567',
        ]);

        Customer::create([
            'name' => 'ТОВ "Гамма"',
            'email' => 'office@gamma.com',
            'phone' => '+380931234567',
        ]);
    }
}
