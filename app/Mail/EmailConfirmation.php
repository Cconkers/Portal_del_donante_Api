<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('soporte@fundacion.es')
        ->to($this->data['email'])
        ->subject('Por favor ' . $this->data['name'] . $this->data['lastName'] . ' confirme su correo electrónico')
        ->markdown('mails.confirmation')
        ->with([
            'name' => $this->data['name'],
            'lastName' => $this->data['lastName'],
            'email' => $this->data['email']
        ]);
    }
}
