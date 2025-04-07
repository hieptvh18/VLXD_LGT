<?php

namespace App\Listeners;

use App\Events\UserLogined;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SaveAdvanedInfoUser
{

    /**
     * Handle the event.
     */
    public function handle(UserLogined $event): void
    {
        try {
            $user = $event->user;

            // save advanced info login
            $user->last_activity = now();
            $user->ip = $event->ip;
            $user->save();
        }catch (\Exception $e){
            Log::error($e->getMessage());
        }
    }
}
