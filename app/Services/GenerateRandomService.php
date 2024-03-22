<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Str;
use App\Models\TradingAccount;
use App\Models\Brand;

class GenerateRandomService extends Service
{


    public static function RandomStr($int)
    {
        return Str::random($int);
    }

   public static function RandomSixString()
   {
    return mt_rand(100000, 999999);
   }
    public static function RandomCustomer()
    {
        do {
            $key = TradingAccount::$CUSTOMER.self::RandomSixString();
        } while (TradingAccount::where("login_id", "=", $key)->first());

        return $key;
    }

    public static function RandomBrand()
    {
        do {
            $key = Brand::$BRAND.self::RandomSixString();
        } while (Brand::where("login_id", "=", $key)->first());

        return $key;
    }

    public static function getCustomerPublicKey($brand_id)
    {

        $key = TradingAccount::$PREFIX.self::RandomSixString().time().'AR345WTSQ2567'.self::RandomSixString().'AR345WTSQ2567'.$brand_id;
        return $key;
    }

    public static function getBrandPublicKey()
    {

        $key = Brand::$BRAND.self::RandomSixString().time().'AR345WTSQ2567'.self::RandomSixString();
        return $key;
    }


}