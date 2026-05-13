<?php

namespace App\Mail;

use App\Models\Thesis;
use Illuminate\Mail\Mailable;

class ThesisInvitationMail extends Mailable
{
    public  $thesis;
    public  $examiner;

    public function __construct($thesis,  $examiner)
    {
        $this->thesis = $thesis;
        $this->examiner = $examiner;
    }

    public function build()
    {
        return $this->subject('Permohonan Penilaian Tugas Akhir')
            ->view('emails.thesis-invitation');
    }
}
