<?php
namespace App\Traits\Models;


trait HasIp
{

    public static function add(array $data)
    {
        return  static::updateOrCreate(
            [
                'ip_address' =>  $data['ip_address'],
            ],
            [
                'ip_address' =>  $data['ip_address'],
                'brand_id' =>  $data['brand_id'],
                'status' =>  $data['status'],
            ]
        );
    }

}
