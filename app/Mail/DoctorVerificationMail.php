<?php

namespace App\Mail;

use App\Models\Doctor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\View;

class DoctorVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $doctor;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Doctor $doctor)
    {
        $this->doctor = $doctor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(View::exists('mails.doctor_verifycation')){
            return $this->view('mails.doctor_verifycation');
        }
    }
}
