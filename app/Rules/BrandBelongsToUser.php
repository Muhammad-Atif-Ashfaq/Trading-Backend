<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\User;

class BrandBelongsToUser implements ValidationRule
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exists = User::query()
            ->where('brand_id', $value)
            ->where('id', $this->userId)
            ->exists();

        if (!$exists) {
            $fail("The $attribute does not belong to the specified user.");
        }
    }
}