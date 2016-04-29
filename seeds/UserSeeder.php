<?php

namespace app\seeds;

use tebazil\yii2seeder\Seeder;
use Yii;

class UserSeeder
{
    public function seed()
    {
        $seeder = new Seeder();

        $users = [
            [
                'username' => 'Clearasil', 
                'password' => Yii::$app->getSecurity()->generatePasswordHash('admin'), 
                'email' => 'derkvanderheide@hotmail.com', 
                'auth_key' => Yii::$app->getSecurity()->generateRandomString(), 
                'access_token' => Yii::$app->getSecurity()->generateRandomString(),
            ],
        ];

        $seeder->table('users')->data($users)->rowQuantity(count($users));

        $seeder->refill();

        echo 'Database seeded' . "\n";
    }
}