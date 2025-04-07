<?php

namespace App\Listeners;

use App\Events\SaveIsFirstPageNews;
use App\Models\News;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdateIsFirstPageNews
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SaveIsFirstPageNews $event): void
    {
        try{
            News::where('is_first_page', 1)
                ->where('id', '<>', $event->news->id)
                ->update(['is_first_page' => 0]);

        }catch (\Exception $e){
            Log::error($e->getMessage());
        }
    }
}
