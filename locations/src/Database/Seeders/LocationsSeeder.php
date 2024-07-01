<?php

namespace Ahantu\Locations\Database\Seeders;

use Illuminate\Database\Seeder;
use Ahantu\Locations\Models\Province;
use Ahantu\Locations\Models\District;
use Ahantu\Locations\Models\Sector;
use Ahantu\Locations\Models\Cell;
use Ahantu\Locations\Models\Village;

class LocationsSeeder extends Seeder
{
    public function run()
    {
        Province::insert([
            ['id' => 1, 'name' => 'Kigali City'],
            ['id' => 2, 'name' => 'Southern Province'],
            ['id' => 3, 'name' => 'Western Province'],
            ['id' => 4, 'name' => 'Northern Province'],
            ['id' => 5, 'name' => 'Eastern Province']
        ]);

        District::insert([
            ['id' => 101, 'name' => 'NYARUGENGE', 'province_id' => 1],
            ['id' => 102, 'name' => 'GASABO', 'province_id' => 1],
            ['id' => 103, 'name' => 'KICUKIRO', 'province_id' => 1],
            ['id' => 201, 'name' => 'NYANZA', 'province_id' => 2],
            ['id' => 202, 'name' => 'GISAGARA', 'province_id' => 2]
        ]);

        Sector::insert([
            ['id' => 10101, 'name' => 'Gitega', 'district_id' => 101],
            ['id' => 10102, 'name' => 'Kanyinya', 'district_id' => 101],
            ['id' => 10103, 'name' => 'Kigali', 'district_id' => 101],
            ['id' => 10104, 'name' => 'Kimisagara', 'district_id' => 101],
            ['id' => 10105, 'name' => 'Mageragere', 'district_id' => 101]
        ]);

        Cell::insert([
            ['id' => 1010101, 'name' => 'Akabahizi', 'sector_id' => 10101],
            ['id' => 1010102, 'name' => 'Akabeza', 'sector_id' => 10101],
            ['id' => 1010103, 'name' => 'Gacyamo', 'sector_id' => 10101],
            ['id' => 1010104, 'name' => 'Kigarama', 'sector_id' => 10101]
        ]);

        Village::insert([
            ['id' => 101010102, 'name' => 'Gihanga', 'cell_id' => 1010101],
            ['id' => 101010103, 'name' => 'Iterambere', 'cell_id' => 1010101],
            ['id' => 101010104, 'name' => 'Izuba', 'cell_id' => 1010101],
            ['id' => 101010105, 'name' => 'Nyaburanga', 'cell_id' => 1010101]
        ]);
    }
}
