<?php

namespace App\Listeners;

use App\Events\ClassCanceled;
use App\Jobs\NotifyClasCancelJob;
use App\Mail\ClassCanceledMail;
use App\Notifications\ClassCanceledNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notifiable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class NotifyClassCanceled
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ClassCanceled $event): void
    {
//        $scheduledClass = $event->scheduledClass;

        $members = $event->scheduledClass->members()->get();
//        $members = $event->scheduledClass->members();

        $className = $event->scheduledClass->classType->name;
        $classDateTime = $event->scheduledClass->date_time;

        $details = compact('className','classDateTime');

//        $members->each(function($user) use ($details){
//            Mail::to($user)->send(new ClassCanceledMail($details));
//        });

        Notification::send($members, new ClassCanceledNotification($details));

//        NotifyClasCancelJob::dispatch($members, $details);
    }
}
