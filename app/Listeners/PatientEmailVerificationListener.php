<?php

namespace App\Listeners;

use App\Mail\PatientVerificationMail;
use App\Models\Patient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use function info;
use function print_r;

class PatientEmailVerificationListener implements ShouldQueue
{
    public $patient;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to($event->patient->email)->queue(new PatientVerificationMail($event->patient));
    }
}
