<?php

namespace App\Mail;

use App\Models\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use function info;
use Illuminate\Support\Facades\View;

class PatientResetPassMail extends Mailable 
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $patient;
    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
        info($this->patient);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(View::exists('mails.patient-reset-password')){
            return $this->view('mails.patient-reset-password');
        }
    }
}
