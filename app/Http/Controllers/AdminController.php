<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (Session::get('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $adminUser = env('ADMIN_USERNAME', 'admin');
        $adminPass = env('ADMIN_PASSWORD', 'password');

        if ($request->username === $adminUser && $request->password === $adminPass) {
            Session::put('admin_logged_in', true);
            Session::put('admin_username', $request->username);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['login' => 'Username atau password salah.'])->withInput();
    }

    public function logout()
    {
        Session::forget('admin_logged_in');
        Session::forget('admin_username');
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $today = today();

        $currentQueue = Booking::where('status', 'in_progress')
            ->whereDate('booking_date', $today)
            ->with('service')
            ->orderBy('queue_number')
            ->first();

        $waitingList = Booking::where('status', 'waiting')
            ->whereDate('booking_date', $today)
            ->with('service')
            ->orderBy('queue_number')
            ->get();

        $doneToday = Booking::where('status', 'done')
            ->whereDate('booking_date', $today)
            ->count();

        $totalToday = Booking::whereDate('booking_date', $today)
            ->whereIn('status', ['waiting', 'in_progress', 'done'])
            ->count();

        // Total penjualan online yang sudah dicatat hari ini
        $todaySales = Booking::where('status', 'done')
            ->whereDate('booking_date', $today)
            ->sum('sale_amount');

        return view('admin.dashboard', compact(
            'currentQueue', 'waitingList', 'doneToday', 'totalToday', 'todaySales'
        ));
    }

    public function callNext()
    {
        $today = today();

        // Mark current in-progress as done
        Booking::where('status', 'in_progress')
            ->whereDate('booking_date', $today)
            ->update(['status' => 'done']);

        // Get next waiting booking
        $next = Booking::where('status', 'waiting')
            ->whereDate('booking_date', $today)
            ->orderBy('queue_number')
            ->first();

        if ($next) {
            $next->update(['status' => 'in_progress']);
            return back()->with('success', "Nomor antrian {$next->queue_number} – {$next->name} dipanggil!");
        }

        return back()->with('info', 'Tidak ada antrian yang menunggu.');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status'       => 'required|in:waiting,in_progress,done,cancelled',
            'sale_amount'  => 'nullable|numeric|min:0',
        ]);

        $status = $request->status;
        $queueLabel = str_pad($booking->queue_number, 3, '0', STR_PAD_LEFT);

        if ($status === 'done') {
            // Simpan jumlah penjualan yang diinput admin (0 jika tidak diisi)
            $booking->sale_amount = $request->filled('sale_amount')
                ? (float) $request->sale_amount
                : 0;
            $booking->status = 'done';
            $booking->save();

            $formatted = 'Rp ' . number_format($booking->sale_amount, 0, ',', '.');
            return back()->with('success',
                "Antrian #{$queueLabel} ({$booking->name}) selesai. Penjualan dicatat: {$formatted}"
            );
        }

        $booking->update(['status' => $status]);
        return back()->with('success', "Status antrian #{$queueLabel} diperbarui.");
    }

    public function allBookings(Request $request)
    {
        $date = $request->get('date', today()->toDateString());

        $bookings = Booking::whereDate('booking_date', $date)
            ->with('service')
            ->orderBy('queue_number')
            ->get();

        return view('admin.bookings', compact('bookings', 'date'));
    }
}
