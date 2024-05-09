<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;

    const ADMIN = 'admin';

    const BRAND = 'brand';

    const BRAND_CUSTOMER = 'brand Customer';

    const PERMINENT_ROLES = [self::ADMIN, self::BRAND,self::BRAND_CUSTOMER];

    protected static function boot()
    {
        parent::boot();

//        static::addGlobalScope(fn(Builder $builder) => $builder->whereNotIn('name', self::PERMINENT_ROLES));

        self::creating(fn($model) => $model->guard_name = 'web');
    }
}
