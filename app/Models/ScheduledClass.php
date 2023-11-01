<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class ScheduledClass extends Model
{
    use HasFactory;

    protected $guarded = null;

    protected $casts = [
        'date_time' => 'datetime'
    ];

    public function instructor() {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function classType() {
        return $this->belongsTo(ClassType::class);
    }

    /*
     * all the members who booked this scheduled class
     */
    public function members() {
        return $this->belongsToMany(User::class, 'bookings');
    }

    public function scopeUpcoming(\Illuminate\Database\Eloquent\Builder $query) {
        return $query->where('date_time','>', now());
    }

    public function scopeNotBooked(\Illuminate\Database\Eloquent\Builder $query) {
        return
            //filter classes that are already booked(which have relationship with member - booking)
            $query->whereDoesntHave('members', function ($query){
            //filter user who already booked the class
            $query->where('user_id', auth()->user()->id);
        });
    }
}
