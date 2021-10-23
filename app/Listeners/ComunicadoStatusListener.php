<?php

namespace App\Listeners;

use App\Events\ComunicadoStatusEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ComunicadoStatusListener
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
     * @param  ComunicadoStatusEvent  $event
     * @return void
     */
    public function handle(ComunicadoStatusEvent $event)
    {
        //
    }
}
