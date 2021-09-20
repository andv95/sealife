<?php

namespace App\Mail\Site;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $viewName;
    private $options;
    public $data;

    /**
     * SendMail constructor.
     *
     * @param string $viewName
     * @param array $data
     * @param array $options
     */
    public function __construct(string $viewName, array $data = [], array $options = [])
    {
        $this->viewName = $viewName;
        $this->data = $data;
        $this->options = $options;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (setting('site.email_received')) {
            $email_string = setting('site.email_received');
            $received_email = explode(',', $email_string);
            $mail = $this->view($this->viewName)->cc($received_email);
        } else {
            $mail = $this->view($this->viewName);
        }

        if (array_key_exists("subject", $this->options)) {
            $mail = $mail->subject($this->options["subject"]);
        }

        return $mail;
    }
}
