<?php

namespace App\Listeners;

use App\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendNotification
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
     * @param  MessageSent  $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
        $contact_message = $event->message;
        Mail::send('email.contact-message-notification', ['contact_message' => $contact_message], function($m) use($contact_message){
            $m->from('info@ecdigital.fr', 'EC Digital');
            $m->to($contact_message->email, 'EC Digital Admin'); // c'est idiot de l'envoyer à lui, mais c'est juste pour l'exemple
            $m->subject('Nouveau message de '.$contact_message->email);
        });
    }
}
