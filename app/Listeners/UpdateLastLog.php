<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Logout;


class UpdateLastLog
{


    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        $event->user->last_log = Carbon::now();
        $event->user->save();
    }
}
