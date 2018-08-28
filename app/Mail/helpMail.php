<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class helpMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $datahelp;   

    public function __construct($data)
    {
        $this->datahelp = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
         // Array for Blade
        
        return $this->markdown('emails.help')
        ->with([
            'nombre'     => $this->datahelp['nombre'],
            'email'     => $this->datahelp['email'],
            'asunto'     => $this->datahelp['asunto'],
            'mensaje'     => $this->datahelp['mensaje'],
        ]);
    }
}
