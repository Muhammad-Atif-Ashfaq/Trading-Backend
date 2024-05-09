<?php

namespace App\Enums;

final class LeverageEnum
{
     const LEVERAGE_1_TO_1 = '100';
     const LEVERAGE_2_TO_1 = '50';
     const LEVERAGE_3_TO_1 = '33';
     const LEVERAGE_4_TO_1 = '25';
     const LEVERAGE_5_TO_1 = '20';
     const LEVERAGE_10_TO_1 = '10';
     const LEVERAGE_20_TO_1 = '5';
     const LEVERAGE_30_TO_1 = '3.33';
     const LEVERAGE_50_TO_1 = '2';
     const LEVERAGE_100_TO_1 = '1';
     const LEVERAGE_400_TO_1 = '0.25';
     const LEVERAGE_1000_TO_1 = '0.10';


    const LEVERAGE_1_TO_1_TEXT = '1:1';
    const LEVERAGE_2_TO_1_TEXT = '2:1';
    const LEVERAGE_3_TO_1_TEXT = '3:1';
    const LEVERAGE_4_TO_1_TEXT = '4:1';
    const LEVERAGE_5_TO_1_TEXT = '5:1';
    const LEVERAGE_10_TO_1_TEXT = '10:1';
    const LEVERAGE_20_TO_1_TEXT = '20:1';
    const LEVERAGE_30_TO_1_TEXT = '30:1';
    const LEVERAGE_50_TO_1_TEXT = '50:1';
    const LEVERAGE_100_TO_1_TEXT = '100:1';
    const LEVERAGE_400_TO_1_TEXT = '400:1';
    const LEVERAGE_1000_TO_1_TEXT = '1000:1';

    // TODO: Define a method to retrieve all available Leverage list .
    public static function getLeverages()
    {
        return [
            self::LEVERAGE_1_TO_1,
            self::LEVERAGE_2_TO_1,
            self::LEVERAGE_3_TO_1,
            self::LEVERAGE_4_TO_1,
            self::LEVERAGE_5_TO_1,
            self::LEVERAGE_10_TO_1,
            self::LEVERAGE_20_TO_1,
            self::LEVERAGE_30_TO_1,
            self::LEVERAGE_50_TO_1,
            self::LEVERAGE_100_TO_1,
            self::LEVERAGE_400_TO_1,
            self::LEVERAGE_1000_TO_1,
        ];
    }

    // TODO: Define a method to retrieve all available all  Leverage.
    public static function getAllLeverage()
    {
        return [
            self::LEVERAGE_1_TO_1 => self::LEVERAGE_1_TO_1_TEXT,
            self::LEVERAGE_2_TO_1 => self::LEVERAGE_2_TO_1_TEXT,
            self::LEVERAGE_3_TO_1 => self::LEVERAGE_3_TO_1_TEXT,
            self::LEVERAGE_4_TO_1 => self::LEVERAGE_4_TO_1_TEXT,
            self::LEVERAGE_5_TO_1 => self::LEVERAGE_5_TO_1_TEXT,
            self::LEVERAGE_10_TO_1 => self::LEVERAGE_10_TO_1_TEXT,
            self::LEVERAGE_20_TO_1=> self::LEVERAGE_20_TO_1_TEXT,
            self::LEVERAGE_30_TO_1 => self::LEVERAGE_30_TO_1_TEXT,
            self::LEVERAGE_50_TO_1 => self::LEVERAGE_50_TO_1_TEXT,
            self::LEVERAGE_100_TO_1 => self::LEVERAGE_100_TO_1_TEXT,
            self::LEVERAGE_400_TO_1 => self::LEVERAGE_400_TO_1_TEXT,
            self::LEVERAGE_1000_TO_1 => self::LEVERAGE_1000_TO_1_TEXT,
        ];
    }

    // TODO: Method to get the numerical values based on the text representation
    public static function getValuesFromText($text)
    {
        $leverages = self::getAllLeverage();
        $matchedValues = [];

        foreach ($leverages as $value => $textValue) {
            // Check if the given text is contained within the text representation
            if (strpos($textValue, $text) !== false) {
                $matchedValues[] = $value; // Add the numerical value to the array
            }
        }

        return $matchedValues;
    }



}
