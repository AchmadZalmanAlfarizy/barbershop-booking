@extends('layouts.app')

@section('title', 'Cek Status Antrian')

@section('content')

<div class="max-w-lg mx-auto">

    <div class="text-center mb-8">
        <div class="bg-orange-100 rounded-full w-20 h-20 flex items-center justify-center text-4xl mx-auto mb-4 shadow">
            🔍
        </div>
        <h1 class="text-3xl font-extrabold text-gray-800 mb-2">Cek Status Antrian</h1>
        <p class="text-gray-500">Masukkan nomor HP yang kamu gunakan saat booking untuk melihat status antrian hari ini.</p>
    </div>

    {{-- Search Form --}}
    <form method="POST" action="{{ route('booking.check') }}" class="bg-white rounded-2xl shadow p-6 mb-6">
        @csrf
        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor HP / WhatsApp</label>
        <div class="flex gap-3">
            <input
                type="text"
                name="phone"
                value="{{ old('phone', request('phone')) }}"
                placeholder="Contoh: 08123456789"
                class="flex-1 border border-gray-300 rounded-xl px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                autofocus
            >
            <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white font-bold px-6 py-3 rounded-xl transition shadow">
                Cek
            </button>
        </div>
        @error('phone')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </form>

    {{-- Error State --}}
    @if($error)
        <div class="bg-red-50 border-2 border-red-200 rounded-2xl p-6 text-center">
            <p class="text-4xl mb-3">😕</p>
            <p class="text-red-700 font-semibold text-lg">{{ $error }}</p>
            <p class="text-gray-500 text-sm mt-2">
                Pastikan nomor HP sesuai dan booking dibuat untuk hari ini.
            </p>
            <a href="{{ route('booking.create') }}"
               class="inline-block mt-4 bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-2 rounded-xl transition">
                Booking Sekarang
            </a>
        </div>
    @endif

    {{-- Result Card --}}
    @if($booking)

        {{-- Status: In Progress --}}
        @if($booking->status === 'in_progress')
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-3xl p-8 shadow-2xl text-center mb-4 animate-pulse">
                <p class="text-blue-100 text-sm font-semibold uppercase tracking-widest mb-2">🎉 Giliran Kamu Sekarang!</p>
                <p class="text-8xl font-black leading-none mb-3">
                    {{ str_pad($booking->queue_number, 3, '0', STR_PAD_LEFT) }}
                </p>
                <p class="text-blue-100 text-base">Silakan segera menuju kursi barber</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-5 space-y-3">
                <p class="font-bold text-gray-700 text-sm uppercase tracking-wide mb-2">Detail Booking</p>
                @include('booking._detail_rows', ['booking' => $booking])
            </div>

        {{-- Status: Waiting --}}
        @elseif($booking->status === 'waiting')
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-3xl p-8 shadow-2xl text-center mb-4">
                <p class="text-orange-100 text-sm font-semibold uppercase tracking-widest mb-2">Nomor Antrian Kamu</p>
                <p class="text-8xl font-black leading-none mb-3">
                    {{ str_pad($booking->queue_number, 3, '0', STR_PAD_LEFT) }}
                </p>
                <div class="bg-white/20 rounded-xl px-6 py-3 inline-block">
                    <p class="text-orange-100 text-sm">Posisi dalam antrian</p>
                    <p class="text-4xl font-bold">ke-{{ $position }}</p>
                </div>
                @if($estimatedWait > 0)
                    <p class="text-orange-100 text-sm mt-3">⏱ Estimasi tunggu: ~{{ $estimatedWait }} menit</p>
                @else
                    <p class="text-orange-100 text-sm mt-3">⚡ Kamu yang pertama antri!</p>
                @endif
            </div>
            <div class="bg-white rounded-2xl shadow p-5 space-y-3 mb-4">
                <p class="font-bold text-gray-700 text-sm uppercase tracking-wide mb-2">Detail Booking</p>
                @include('booking._detail_rows', ['booking' => $booking])
            </div>
            <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-4 text-center text-yellow-800 text-sm">
                💡 Tetap pantau halaman ini atau lihat layar antrian di barbershop
            </div>
        @endif

        {{-- Action Buttons --}}
        <div class="flex gap-3 mt-6">
            <a href="{{ route('booking.check') }}"
               class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-xl text-center transition">
                ← Cek Ulang
            </a>
            <a href="{{ route('queue.display') }}" target="_blank"
               class="flex-1 bg-gray-800 hover:bg-gray-900 text-white font-semibold py-3 rounded-xl text-center transition">
                📺 Layar Antrian
            </a>
        </div>

    @endif

    {{-- Empty State (first visit) --}}
    @if(! $booking && ! $error && request()->isMethod('get'))
        <div class="bg-white rounded-2xl shadow p-6 text-center text-gray-400">
            <p class="text-5xl mb-3">📋</p>
            <p class="font-semibold text-gray-500">Masukkan nomor HP di atas untuk melihat status antrian kamu.</p>
        </div>
    @endif

</div>

@endsection
