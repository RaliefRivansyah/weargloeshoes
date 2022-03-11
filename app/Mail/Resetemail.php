<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class Resetemail extends Mailable
{
    use Queueable, SerializesModels;
    private $nama, $id, $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nama, $id, $token)
    {
        $this->nama = $nama;
        $this->id = $id;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->withSwiftMessage(function ($message) {
            $message->getHeaders()->addTextHeader(
                'Weargloeshoes', 'Official Email'
            );
        });
        $this->from("gloeshoesleather@gmail.com", "Weargloeshoes")
            ->view('resetemail')
            ->with(
                [
                    'nama' => $this->nama,
                    'website' => "weargloeshoes.com",
                    'link' => URL::to('/reset-email/' . $this->token)
                ]
            )->subject("Weargloeshoes Reset Email");
        return $this;
    }
}
