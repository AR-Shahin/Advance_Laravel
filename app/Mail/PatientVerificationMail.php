<?php

namespace App\Mail;

use App\Models\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\View;
use function info;

class PatientVerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $patient;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        info('i am fm mail');
        if(View::exists('mails.patient_verification')){
            return $this->view('mails.patient_verification');
        }
    }
}
