<?php

namespace Database\Seeders;

use App\Models\DataFeed;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DataFeedsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data_feed = new DataFeed;
        $data_feed->name = 'binance';
        $data_feed->module = 'binance';
        $data_feed->feed_server = 'https://api.binance.com/api/v3';
        $data_feed->feed_login = '';
        $data_feed->feed_password = '';
        $data_feed->save();

    }
}
