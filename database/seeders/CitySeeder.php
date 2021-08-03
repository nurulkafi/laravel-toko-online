<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fileKota = file_get_contents(base_path('/database/kota.json'));
        $fileKab = file_get_contents(base_path('/database/kabupaten.json'));

        $dataKota = json_decode($fileKota, true);
        $dataKab = json_decode($fileKab, true);

        City::insert($dataKota);
        City::insert($dataKab);
    }
}
