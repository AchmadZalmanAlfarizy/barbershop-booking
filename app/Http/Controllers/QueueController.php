<?php

namespace App\Http\Controllers;

use App\Models\Booking;

class QueueController extends Controller
{
    public function display()
    {
        $today = today();

        $currentQueue = Booking::where('status', 'in_progress')
            ->whereDate('booking_date', $today)
            ->with('service')
            ->first();

        $waitingList = Booking::where('status', 'waiting')
            ->whereDate('booking_date', $today)
            ->with('service')
            ->orderBy('queue_number')
            ->take(10)
            ->get();

        $doneCount = Booking::where('status', 'done')
            ->whereDate('booking_date', $today)
            ->count();

        return view('queue.display', compact('currentQueue', 'waitingList', 'doneCount'));
    }
}
