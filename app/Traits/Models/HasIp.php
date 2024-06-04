<?php
namespace App\Traits\Models;


trait HasIp
{

    public static function add($ip)
    {
        return  static::updateOrCreate(
            [
                'ip_address' =>  $ip
            ],
            [
                'ip_address' => $ip,
            ]
        );
    }

}
