<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
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
        return $this->from($this->data['email'])
                    ->to('admin@fundacion.es')
                       ->subject('Registro de usuario nuevo')
                       ->markdown('mails.registro')
                       ->with([
                        'name' => $this->data['name'],
                        'lastName'=>$this->data['lastName'],
                        'tipoDocumento'=> $this->data['tipoDocumento'],
                        'documento' => $this->data['documento'],
                        'selectorPais'=>$this->data['selectorPais'],
                        'direccion'=>$this->data['direccion'],
                        'provincia'=> $this->data['provincia'],
                        'poblacion'=> $this->data['poblacion'],
                        'cp'=>$this->data['cp'],
                        'cuota'=> $this->data['cuota'],
                        'tipoCuota'=> $this->data['tipoCuota'],
                        'phoneNumber'=>$this->data['phoneNumber'],
                        'phoneNumber2'=>$this->data['phoneNumber2'],
                        'nameBank'=>$this->data['nameBank'],
                        'iban'=> $this->data['iban'],
                      ]);
    }
}
