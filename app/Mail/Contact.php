<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $sendFields;
    public $subject;
    public $attach;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sendFields, $subject, $attach)
    {
        $this->sendFields = $sendFields;
        $this->subject = $subject;
        $this->attach = $attach;
    }
    public function attachments()
    {
        $files = [];
        foreach($this->attach as $file) {
            $files[]=Attachment::fromPath($file->getRealPath())
            ->as($file->getClientOriginalName())
            ->withMime($file->getMimeType());
            
        }
        return $files;
    
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact')->subject($this->subject);
    }
}
