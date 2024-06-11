<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Str;
use App\Models\TradingAccount;
use App\Models\Brand;

class GenerateRandomService extends Service
{
    // TODO: Generate a random string of specified length.
    public static function RandomStr($int)
    {
        return Str::random($int);
    }

    // TODO: Generate a random six-digit string.
    public static function RandomSixString()
    {
        return mt_rand(100000, 999999);
    }

    // TODO: Generate a random customer key.
    public static function RandomCustomer()
    {
        do {
            $key = TradingAccount::$CUSTOMER . self::RandomSixString();
        } while (TradingAccount::where("login_id", "=", $key)->first());

        return $key;
    }

    // TODO: Generate a  customer id key.
    public static function CustomerId()
    {
        $maxLoginId = TradingAccount::max('login_id');
        $newLoginId = $maxLoginId + 1;
        $formattedLoginId = str_pad($newLoginId, 6, '0', STR_PAD_LEFT);

        return $formattedLoginId;
    }


    // TODO: Generate a random brand key.
    public static function RandomBrand()
    {
        do {
            $key = Brand::$BRAND . self::RandomSixString();
        } while (Brand::where("public_key", "=", $key)->first());

        return $key;
    }

    // TODO: Generate a customer public key.
    public static function getCustomerPublicKey($brand_id)
    {
        $key = TradingAccount::$PREFIX . self::RandomSixString() . time() . 'AR345WTSQ2567' . self::RandomSixString() . 'AR345WTSQ2567' . $brand_id;
        return $key;
    }

    // TODO:Generate a brand public key.
    public static function getBrandPublicKey()
    {
        $key = Brand::$BRAND . self::RandomSixString() . time() . 'AR345WTSQ2567' . self::RandomSixString();
        return $key;
    }
}
