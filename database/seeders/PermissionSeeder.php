<?php

namespace Database\Seeders;

use App\Helpers\PaginationHelper;
use App\Helpers\PermissionsHelper;
use App\Models\DataFeed;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        PermissionsHelper::generateModelPermissions();

    }
}
