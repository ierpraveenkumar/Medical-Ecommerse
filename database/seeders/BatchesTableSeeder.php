<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BatchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('batches')->insert([
            [
                'batch_no' => '23M056',
                'batch_import_date' => now(),
                'mfg_date' => now(),
                'expiry_date' => now(),
                'quantity' => 100,
                'product_type' => 'Kit',
                'status' => 'Inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'batch_no' => '23M057',
                'batch_import_date' => now(),
                'mfg_date' => now(),
                'expiry_date' => now(),
                'quantity' => 10,
                'product_type' => 'Kit',
                'status' => 'Active', // Corrected the status value
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'batch_no' => '23M058',
                'batch_import_date' => now(),
                'mfg_date' => now(),
                'expiry_date' => now(),
                'quantity' => 100,
                'product_type' => 'Kit',
                'status' => 'Inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more records here
            // ...
        ]);
    }
}
