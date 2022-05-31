<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use \App\Visitor;
use \App\Event;

class ConfirmRegistration extends Mailable
{
    use Queueable, SerializesModels;

    protected $visitor;
    protected $event;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\VWVisitor $visitor, \App\Event $event)
    {
        $this->visitor = $visitor;
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('rstw.dost3@gmail.com')->view('prereg.registrationmail')->with([
            'visitor' => $this->visitor,
            'event' => $this->event,
            'barcode' => $this->visitor->vis_code,
            ]);
    }
}
