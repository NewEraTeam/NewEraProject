<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BookingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData;

    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    public function build()
    {
        //Log::info('Email Data:', $this->emailData); // Logs to the Laravel log file
        //dd($this->emailData); // This works, so $emailData is being passed correctly
        // $renderedView = view('Mailables.BookingConfirmationMail', ['emailData' => $this->emailData])->render();
        // dd($renderedView);

        return $this->subject('Booking Confirmation')
                    ->view('Mailables.BookingConfirmationMail', ['emailData' => $this->emailData]);
    }
}
