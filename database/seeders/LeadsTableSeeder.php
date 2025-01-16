<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leads')->insert([
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'payment_link' => true,
                'prescription_link' => false,
                'converted_to_order' => false,
                'generated_on' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jony',
                'last_name' => 'Doe',
                'email' => 'jony@example.com',
                'payment_link' => true,
                'prescription_link' => false,
                'converted_to_order' => false,
                'generated_on' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'JAbby',
                'last_name' => 'Doel',
                'email' => 'jaby@example.com',
                'payment_link' => true,
                'prescription_link' => true,
                'converted_to_order' => false,
                'generated_on' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more records here
            // ...
        ]);
    }
}
