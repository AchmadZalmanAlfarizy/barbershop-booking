<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $services = Service::active()->orderBy('name')->get();

        $currentQueue = Booking::where('status', 'in_progress')
            ->whereDate('booking_date', today())
            ->with('service')
            ->first();

        $waitingCount = Booking::where('status', 'waiting')
            ->whereDate('booking_date', today())
            ->count();

        return view('home', compact('services', 'currentQueue', 'waitingCount'));
    }

    public function create()
    {
        $services = Service::active()->orderBy('name')->get();
        return view('booking.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:100',
            'phone'        => 'required|string|max:20',
            'service_id'   => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
        ]);

        // Auto-generate queue number for the day
        $lastQueue = Booking::whereDate('booking_date', $validated['booking_date'])
            ->max('queue_number');

        $queueNumber = ($lastQueue ?? 0) + 1;

        $booking = Booking::create([
            'name'         => $validated['name'],
            'phone'        => $validated['phone'],
            'service_id'   => $validated['service_id'],
            'booking_date' => $validated['booking_date'],
            'booking_time' => $validated['booking_time'],
            'queue_number' => $queueNumber,
            'status'       => 'waiting',
        ]);

        return redirect()->route('booking.confirmation', $booking->id);
    }

    public function confirmation(Booking $booking)
    {
        $booking->load('service');

        // Calculate estimated waiting time
        $waitingBefore = Booking::where('status', 'waiting')
            ->whereDate('booking_date', $booking->booking_date)
            ->where('queue_number', '<', $booking->queue_number)
            ->count();

        $inProgressTime = Booking::where('status', 'in_progress')
            ->whereDate('booking_date', $booking->booking_date)
            ->with('service')
            ->first();

        $remainingInProgress = $inProgressTime ? ($inProgressTime->service->duration ?? 30) : 0;
        $estimatedWait = $remainingInProgress + ($waitingBefore * ($booking->service->duration ?? 30));

        return view('booking.confirmation', compact('booking', 'estimatedWait'));
    }

    public function checkQueue(Request $request)
    {
        $booking       = null;
        $position      = null;
        $estimatedWait = null;
        $error         = null;

        if ($request->isMethod('post') || $request->filled('phone')) {
            $validated = $request->validate([
                'phone' => 'required|string|max:20',
            ]);

            $booking = Booking::where('phone', $validated['phone'])
                ->whereDate('booking_date', today())
                ->whereIn('status', ['waiting', 'in_progress'])
                ->with('service')
                ->orderBy('queue_number')
                ->first();

            if (! $booking) {
                $error = 'Nomor HP tidak ditemukan atau tidak ada booking aktif hari ini.';
            } elseif ($booking->status === 'waiting') {
                $position = Booking::where('status', 'waiting')
                    ->whereDate('booking_date', today())
                    ->where('queue_number', '<', $booking->queue_number)
                    ->count() + 1;

                $inProgress = Booking::where('status', 'in_progress')
                    ->whereDate('booking_date', today())
                    ->with('service')
                    ->first();

                $remainingInProgress = $inProgress ? ($inProgress->service->duration ?? 30) : 0;
                $estimatedWait = $remainingInProgress + (($position - 1) * ($booking->service->duration ?? 30));
            }
        }

        return view('booking.check', compact('booking', 'position', 'estimatedWait', 'error'));
    }
}
