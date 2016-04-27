<?php

namespace app\seeds;

use tebazil\yii2seeder\Seeder;

class CountrySeeder
{
    public function seed()
    {
        $seeder = new Seeder();

        $countries = [
            ['code' => 'AU', 'name' => 'Australia', 'population' => 24016400],
            ['code' => 'BR', 'name' => 'Brazil', 'population' => 205722000],
            ['code' => 'CA', 'name' => 'Canada', 'population' => 35985751],
            ['code' => 'CN', 'name' => 'China', 'population' => 1375210000],
            ['code' => 'DE', 'name' => 'Germany', 'population' => 81459000],
            ['code' => 'FR', 'name' => 'France', 'population' => 64513242],
            ['code' => 'GB', 'name' => 'United Kingdom', 'population' => 65097000],
            ['code' => 'IN', 'name' => 'India', 'population' => 1285400000],
            ['code' => 'RU', 'name' => 'Russia', 'population' => 146519759],
            ['code' => 'US', 'name' => 'United States', 'population' => 322976000],
        ];

        $seeder->table('country')->data($countries)->rowQuantity(count($countries));

        $seeder->refill();

        echo 'Database seeded' . "\n";
    }
}