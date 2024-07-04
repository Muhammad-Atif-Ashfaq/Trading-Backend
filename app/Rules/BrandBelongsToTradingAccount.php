<?php

namespace App\Rules;

use App\Models\TradingAccount;
use Illuminate\Contracts\Validation\Rule;

class BrandBelongsToTradingAccount implements Rule
{
    private $id;

    private $idType;

    public function __construct($id, $idType)
    {
        $this->id = $id;
        $this->idType = $idType;
    }

    public function passes($attribute, $value)
    {
        if ($this->id && $this->idType) {
            return TradingAccount::where($this->idType, $this->id)->where('brand_id', $value)->exists();
        }

        return true;
    }

    public function message()
    {
        return 'The selected brand_id does not belong to the given trading account.';
    }
}
