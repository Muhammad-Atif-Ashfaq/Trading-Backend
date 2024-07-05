<?php

use Pusher\Pusher;

if (! function_exists('pushLiveDate')) {
    function pushLiveDate($channel, $event, $data)
    {
        if (checkPusherPermission($channel, $event)) {
            $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true,
            ]);
            $pusher->trigger($channel, $event, $data);

            return true;
        }

        return false;
    }
}

if (! function_exists('checkPusherPermission')) {
    function checkPusherPermission($table, $action)
    {
        return Config('pusher.permissions.'.$table.'.'.$action);
    }
}
