<?php

namespace App\Listeners;

use App\Events\JurnalUpload;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewJurnalUploaded
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
     * @param  JurnalUpload  $event
     * @return void
     */
    public function handle(JurnalUpload $event)
    {
        //
    }
}
