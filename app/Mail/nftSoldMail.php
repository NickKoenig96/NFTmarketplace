<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class nftSoldMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $address = 'nick.koenig.be@gmail.com';
        $subject = 'One off your nfts has been sold';
        $name = 'Atria';
//dd($this->data);
        return $this->view('emails.nftSoldMail')
                    ->from($address, $name)
                    ->cc($address, $name)
                    ->bcc($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([ 'test_message' => $this->data['message'], 'nft'=> $this->data['nft']]);
                   // ->with([  ]);

    }
}
