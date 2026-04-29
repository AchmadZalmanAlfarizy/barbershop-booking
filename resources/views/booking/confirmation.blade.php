@extends('layouts.app')

@section('title', 'Konfirmasi Booking')

@section('content')

<div class="max-w-lg mx-auto text-center">

    {{-- Success Icon --}}
    <div class="bg-green-100 rounded-full w-24 h-24 flex items-center justify-center text-5xl mx-auto mb-6 shadow">
        ✅
    </div>

    <h1 class="text-3xl font-extrabold text-gray-800 mb-2">Booking Berhasil!</h1>
    <p class="text-gray-500 mb-8">Simpan nomor antrian kamu di bawah ini.</p>

    {{-- Queue Number Card --}}
    <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-3xl p-8 shadow-2xl mb-6">
        <p class="text-orange-100 text-sm font-medium uppercase tracking-widest mb-2">Nomor Antrian</p>
        <p class="text-8xl font-black leading-none">{{ str_pad($booking->queue_number, 3, '0', STR_PAD_LEFT) }}</p>
        <p class="text-orange-200 text-sm mt-3">{{ $booking->booking_date->format('d F Y') }} · {{ $booking->booking_time }}</p>
    </div>

    {{-- Booking Details --}}
    <div class="bg-white rounded-2xl shadow p-5 text-left mb-6 space-y-3">
        <div class="flex justify-between py-2 border-b border-gray-100">
            <span class="text-gray-500">Nama</span>
            <span class="font-semibold text-gray-800">{{ $booking->name }}</span>
        </div>
        <div class="flex justify-between py-2 border-b border-gray-100">
            <span class="text-gray-500">Nomor HP</span>
            <span class="font-semibold text-gray-800">{{ $booking->phone }}</span>
        </div>
        <div class="flex justify-between py-2 border-b border-gray-100">
            <span class="text-gray-500">Layanan</span>
            <span class="font-semibold text-gray-800">{{ $booking->service->name }}</span>
        </div>
        <div class="flex justify-between py-2 border-b border-gray-100">
            <span class="text-gray-500">Harga</span>
            <span class="font-semibold text-orange-600">
                Rp {{ number_format($booking->service->price, 0, ',', '.') }}
            </span>
        </div>
        <div class="flex justify-between py-2 border-b border-gray-100">
            <span class="text-gray-500">Tanggal</span>
            <span class="font-semibold text-gray-800">
                {{ $booking->booking_date->format('d F Y') }}
            </span>
        </div>
        <div class="flex justify-between py-2 border-b border-gray-100">
            <span class="text-gray-500">Waktu</span>
            <span class="font-semibold text-gray-800">{{ $booking->booking_time }}</span>
        </div>
        @if($estimatedWait > 0)
            <div class="flex justify-between py-2">
                <span class="text-gray-500">Estimasi Tunggu</span>
                <span class="font-semibold text-yellow-600">~{{ $estimatedWait }} menit</span>
            </div>
        @else
            <div class="flex justify-between py-2">
                <span class="text-gray-500">Status</span>
                <span class="font-semibold text-green-600">Langsung Dilayani 🎉</span>
            </div>
        @endif
    </div>

    {{-- WhatsApp Share --}}
    @php
        $waMessage = urlencode(
            "Halo! Saya sudah booking di BarberShop.\n" .
            "Nama: {$booking->name}\n" .
            "Layanan: {$booking->service->name}\n" .
            "Tanggal: {$booking->booking_date->format('d F Y')}\n" .
            "Waktu: {$booking->booking_time}\n" .
            "No. Antrian: " . str_pad($booking->queue_number, 3, '0', STR_PAD_LEFT)
        );
    @endphp
    <a href="https://wa.me/?text={{ $waMessage }}" target="_blank"
       class="block w-full bg-green-500 hover:bg-green-600 text-white text-lg font-bold py-3 rounded-xl shadow transition mb-3">
        📱 Kirim via WhatsApp
    </a>

    <a href="{{ route('booking.check') }}?phone={{ urlencode($booking->phone) }}"
       class="block w-full bg-orange-100 hover:bg-orange-200 text-orange-700 text-lg font-semibold py-3 rounded-xl transition mb-3">
        🔍 Cek Status Antrian
    </a>

    <a href="{{ route('home') }}"
       class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-700 text-lg font-semibold py-3 rounded-xl transition">
        ← Kembali ke Beranda
    </a>
</div>

@endsection
