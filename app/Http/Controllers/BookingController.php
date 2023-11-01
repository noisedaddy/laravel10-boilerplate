<?php

namespace App\Http\Controllers;

use App\Models\ScheduledClass;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create() {
        $scheduledClasses = ScheduledClass::where('date_time', '>', now())
            ->with('classType', 'instructor')
            ->notbooked() //scopeNotBooked
            ->oldest()->get();
        return view('member.book')->with('scheduledClasses', $scheduledClasses);
    }

    public function store(Request $request) {

        //attach a certain entity record to the other entity record in the pivot table
        auth()->user()->bookings()->attach($request->scheduled_class_id);
        return redirect()->route('booking.index');

    }

    public function index() {

        $bookings = auth()->user()->bookings()->upcoming()->get(); //scopeUpcoming

        return view('member.upcoming')->with('bookings', $bookings);
    }

    public function destroy(int $id) {

        //remove a certain entity relationship from the pivot table
        auth()->user()->bookings()->detach($id);
        return redirect()->route('booking.index');
    }
}
