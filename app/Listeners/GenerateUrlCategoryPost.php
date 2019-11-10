<?php

namespace App\Listeners;

use App\Events\CategoryPost;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateUrlCategoryPost
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CategoryPost  $event
     * @return void
     */
    public function handle(CategoryPost $event)
    {
        $event->category()->url = kebab_case($event->category()->title);
    }
}
