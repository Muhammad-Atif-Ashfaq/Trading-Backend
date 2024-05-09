<?php

use Pusher\Pusher;

if(!function_exists('pushLiveDate')){
    function pushLiveDate($channel,$event,$data){
        $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        ]);
        $pusher->trigger($channel,$event,$data);
        return true;
    }
}
