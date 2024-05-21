<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PharmacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    // DB::table('pharmacies')->insert([
    //     'name' => 'Pharmacy 1',
    //     'location' => DB::raw("ST_GeomFromText('POINT(-15.9582 18.0735)', 4326)"),
    //     'created_at' => now(),
    //     'updated_at' => now(),
    // ]);
    // DB::table('export-point')->insert([
    //     'name' => 'Pharmacy 1',
    //     'geom' => DB::raw("ST_GeomFromText('POINT(-15.9582 18.0735)', 4326)"),
    // ]);
}

}
