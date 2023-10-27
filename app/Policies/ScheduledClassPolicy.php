<?php

namespace App\Policies;

use App\Models\ScheduledClass;
use App\Models\User;

class ScheduledClassPolicy
{
    /**
     * ONly instructor can delete scheduled class
     */
    public function delete(User $user, ScheduledClass $scheduledClass)
    {
        return $user->id === $scheduledClass->instructor_id;
    }
}
