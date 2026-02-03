<?php
namespace App\Koketsu\Config;

class Config {
    public static function get()
    {
        return [
            "database" => [
                'driver' => 'mysql',
                'mysql' => [
                    'host' => 'localhost',
                    'db_name' => 'koketsu',
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8mb4',
                    'port' => '3306'
                ]
            ]   
        ];
    }
}
