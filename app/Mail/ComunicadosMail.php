<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SebastianBergmann\Environment\Console;

class ComunicadosMail extends Mailable
{
    use Queueable, SerializesModels;

    public $emails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emails)
    {
        $this->emails = $emails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('suport@donbosco.es')
            ->to($this->emails)
            ->subject('Comunicado nuevo')
            ->markdown('mails.comunicados');
    }
}
