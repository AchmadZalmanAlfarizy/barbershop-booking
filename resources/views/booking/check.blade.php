@extends('layouts.app')

@section('title', 'Cek Status Antrian')

@section('content')

<div class="max-w-lg mx-auto">

    {{-- Header --}}
    <div class="text-center mb-8 fade-in-up">
        <div class="w-16 h-16 bg-gradient-to-br from-amber-500/30 to-amber-500/10 border border-amber-500/30 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-amber-500/20">
            <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        <h1 class="text-3xl font-black text-white mb-2">Cek <span class="text-gold gradient-wave">Antrian</span></h1>
        <p class="text-stone-400">Masukkan nomor HP yang kamu daftarkan saat booking</p>
    </div>

    {{-- Search Form --}}
    <div class="glass-effect rounded-2xl p-6 mb-6 fade-in-up-delayed">
        <form method="GET" action="{{ route('booking.check') }}" class="flex gap-3">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <input type="tel" name="phone"
                       value="{{ request('phone') }}"
                       placeholder="08xxxxxxxxxx"
                       required
                       class="form-input w-full rounded-xl pl-10 pr-4 py-3 text-sm text-white">
            </div>
            <button type="submit"
                    class="btn-gold text-stone-900 font-bold px-5 py-3 rounded-xl flex-shrink-0 shadow-lg shadow-amber-500/30 group">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </form>
    </div>

    {{-- Error State --}}
    @if(isset($error))
        <div class="bg-gradient-to-br from-red-500/20 to-red-500/5 border border-red-500/40 rounded-2xl p-6 text-center glass-effect fade-in-up-delayed" style="animation-delay: 0.2s;">
            <div class="w-12 h-12 bg-gradient-to-br from-red-500/30 to-red-500/10 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <p class="text-red-400 font-semibold">{{ $error }}</p>
            <p class="text-stone-500 text-sm mt-1">Pastikan nomor HP sudah benar atau cek ulang status booking kamu.</p>
        </div>
    @endif

    {{-- Result --}}
    @if(isset($booking))

        {{-- Status: In Progress --}}
        @if($booking->status === 'in_progress')
            <div class="relative bg-gradient-to-br from-blue-600/20 to-blue-500/5 border border-blue-500/40 rounded-2xl p-6 overflow-hidden glass-effect fade-in-up-delayed" style="animation-delay: 0.2s;">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-500/10 rounded-full blur-xl"></div>
                <div class="absolute -bottom-5 -left-5 w-20 h-20 bg-blue-500/5 rounded-full blur-xl"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-5">
                        <span class="relative flex h-3 w-3 badge-live">
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
                        </span>
                        <span class="text-blue-400 font-bold text-sm uppercase tracking-widest">Sedang Dilayani</span>
                    </div>
                    <div class="flex items-center gap-6 mb-6">
                        <div>
                            <p class="text-stone-400 text-xs mb-1">No. Antrian</p>
                            <div class="relative inline-block">
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-blue-500/5 rounded-lg blur-lg"></div>
                                <p class="relative text-6xl font-black text-white leading-none">{{ str_pad($booking->queue_number, 3, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                        <div class="flex-1 space-y-3">
                            <div>
                                <p class="text-stone-500 text-xs font-medium">Nama</p>
                                <p class="text-white font-semibold text-sm">{{ $booking->name }}</p>
                            </div>
                            <div>
                                <p class="text-stone-500 text-xs font-medium">Layanan</p>
                                <p class="text-white font-semibold text-sm">{{ $booking->service->name }}</p>
                            </div>
                            <div>
                                <p class="text-stone-500 text-xs font-medium">Waktu</p>
                                <p class="text-white font-semibold text-sm">{{ $booking->booking_time }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-blue-500/20 to-blue-500/5 border border-blue-500/40 rounded-xl p-4 flex items-center gap-3 glass-effect">
                        <svg class="w-5 h-5 text-blue-400 flex-shrink-0 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        <p class="text-blue-300 text-sm font-medium">Barber sedang melayani kamu sekarang! Silakan masuk ke barbershop.</p>
                    </div>
                </div>
            </div>

        {{-- Status: Waiting --}}
        @elseif($booking->status === 'waiting')
            @php
                $queuePosition = \App\Models\Booking::where('booking_date', $booking->booking_date)
                    ->where('status', 'waiting')
                    ->where('queue_number', '<', $booking->queue_number)
                    ->count() + 1;
                $waitMinutes = ($queuePosition - 1) * 30;
            @endphp
            <div class="relative bg-gradient-to-br from-amber-500/20 to-amber-500/5 border border-amber-500/40 rounded-2xl p-6 overflow-hidden glass-effect fade-in-up-delayed" style="animation-delay: 0.2s;">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-amber-500/10 rounded-full blur-xl"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-5">
                        <span class="relative flex h-3 w-3 badge-live">
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span>
                        </span>
                        <span class="text-amber-400 font-bold text-sm uppercase tracking-widest">Menunggu Giliran</span>
                    </div>

                    <div class="flex items-center gap-6 mb-5">
                        <div>
                            <p class="text-stone-400 text-xs mb-1">No. Antrian</p>
                            <div class="relative inline-block">
                                <div class="absolute inset-0 bg-gradient-to-r from-amber-500/20 to-amber-500/5 rounded-lg blur-lg"></div>
                                <p class="relative text-6xl font-black text-amber-400 leading-none">{{ str_pad($booking->queue_number, 3, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                        <div class="flex-1 space-y-3">
                            <div>
                                <p class="text-stone-500 text-xs font-medium">Nama</p>
                                <p class="text-white font-semibold text-sm">{{ $booking->name }}</p>
                            </div>
                            <div>
                                <p class="text-stone-500 text-xs font-medium">Layanan</p>
                                <p class="text-white font-semibold text-sm">{{ $booking->service->name }}</p>
                            </div>
                            <div>
                                <p class="text-stone-500 text-xs font-medium">Tanggal &amp; Waktu</p>
                                <p class="text-white font-semibold text-sm">{{ $booking->booking_date->format('d/m/Y') }} pukul {{ $booking->booking_time }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <div class="bg-gradient-to-br from-stone-800/60 to-stone-900/40 border border-stone-700/40 rounded-xl p-4 text-center glass-effect">
                            <p class="text-stone-400 text-xs mb-2 font-medium">Posisi Antrian</p>
                            <p class="text-3xl font-black text-amber-400">{{ $queuePosition }}</p>
                            <p class="text-stone-500 text-xs mt-1">dari depan</p>
                        </div>
                        <div class="bg-gradient-to-br from-stone-800/60 to-stone-900/40 border border-stone-700/40 rounded-xl p-4 text-center glass-effect">
                            <p class="text-stone-400 text-xs mb-2 font-medium">Estimasi Tunggu</p>
                            <p class="text-2xl font-black text-amber-400">~{{ $waitMinutes }}</p>
                            <p class="text-stone-500 text-xs">menit lagi</p>
                        </div>
                    </div>

                    @if($queuePosition <= 2)
                        <div class="bg-amber-500/10 border border-amber-500/30 rounded-xl p-3 flex items-center gap-3">
                            <svg class="w-5 h-5 text-amber-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <p class="text-amber-300 text-sm font-medium">Giliran kamu hampir tiba! Segera menuju barbershop.</p>
                        </div>
                    @else
                        <div class="bg-stone-800/60 rounded-xl p-3 flex items-center gap-3">
                            <svg class="w-5 h-5 text-stone-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-stone-400 text-sm">Masih ada {{ $queuePosition - 1 }} orang di depan kamu. Refresh halaman ini untuk update terbaru.</p>
                        </div>
                    @endif
                </div>
            </div>

        {{-- Status: Done --}}
        @else
            <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-2xl p-6 text-center">
                <div class="w-16 h-16 bg-emerald-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <p class="text-emerald-400 font-black text-lg mb-1">Selesai!</p>
                <p class="text-stone-400 text-sm mb-4">
                    Booking <strong class="text-white">{{ $booking->service->name }}</strong> untuk
                    <strong class="text-white">{{ $booking->name }}</strong> telah selesai dilayani.
                </p>
                <p class="text-stone-500 text-xs">Terima kasih sudah menggunakan layanan kami!</p>
            </div>
        @endif

    @elseif(!isset($error))
        {{-- Initial State (no search yet) --}}
        <div class="bg-stone-900 border border-stone-800 rounded-2xl p-8 text-center">
            <div class="w-16 h-16 bg-stone-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <p class="text-stone-400 font-semibold mb-2">Cek Status Antrianmu</p>
            <p class="text-stone-600 text-sm">Masukkan nomor HP yang kamu gunakan saat booking untuk melihat posisi dan estimasi waktu tunggu.</p>
        </div>
    @endif

    <p class="text-center text-stone-500 text-sm mt-6">
        <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors flex items-center justify-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Beranda
        </a>
    </p>

</div>

@endsection
