<?php

namespace App\Listeners;

use App\Mail\DoctorVerificationMail;
use App\Models\Doctor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use function info;

class DoctorCreatedListener implements ShouldQueue
{
    public $doctor;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Doctor $doctor)
    {
        $this->doctor = $doctor;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //info($event->doctor->email);
        $email = $event->doctor->email;
        Mail::to($email)->queue(new DoctorVerificationMail($event->doctor));
    }
}
