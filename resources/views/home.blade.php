@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- Hero Section --}}
<div class="bg-gradient-to-br from-gray-900 to-gray-800 text-white rounded-2xl p-8 mb-8 text-center shadow-xl">
    <h1 class="text-4xl font-extrabold mb-3">✂️ BarberShop</h1>
    <p class="text-gray-300 text-lg mb-6">Booking cepat, antrian mudah. Langsung jalan!</p>

    @if($currentQueue)
        <div class="bg-orange-500 rounded-xl p-4 mb-6 inline-block">
            <p class="text-sm font-medium text-orange-100">Sedang Dilayani</p>
            <p class="text-5xl font-black">{{ str_pad($currentQueue->queue_number, 3, '0', STR_PAD_LEFT) }}</p>
            <p class="text-orange-100 text-sm">{{ $currentQueue->name }} – {{ $currentQueue->service->name }}</p>
        </div>
    @else
        <div class="bg-gray-700 rounded-xl p-4 mb-6 inline-block">
            <p class="text-gray-400 text-sm">Belum ada yang dilayani</p>
        </div>
    @endif

    <div class="flex justify-center gap-6 mb-6 text-center">
        <div class="bg-white/10 rounded-xl px-6 py-3">
            <p class="text-3xl font-bold text-orange-400">{{ $waitingCount }}</p>
            <p class="text-gray-300 text-sm">Menunggu</p>
        </div>
        @if($waitingCount > 0)
            <div class="bg-white/10 rounded-xl px-6 py-3">
                <p class="text-3xl font-bold text-yellow-400">~{{ $waitingCount * 30 }} mnt</p>
                <p class="text-gray-300 text-sm">Estimasi Tunggu</p>
            </div>
        @endif
    </div>

    <div class="flex flex-col sm:flex-row gap-3 justify-center">
        <a href="{{ route('booking.create') }}"
           class="bg-orange-500 hover:bg-orange-600 text-white text-xl font-bold px-10 py-4 rounded-full shadow-lg transition inline-block">
            🗓 Booking Sekarang
        </a>
        <a href="{{ route('booking.check') }}"
           class="bg-white/20 hover:bg-white/30 text-white text-lg font-semibold px-8 py-4 rounded-full transition inline-block border border-white/30">
            🔍 Cek Status Antrian
        </a>
    </div>
</div>

{{-- Services Section --}}
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Layanan Kami</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($services as $service)
            <div class="bg-white rounded-2xl shadow p-5 border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-orange-100 text-orange-600 rounded-full w-12 h-12 flex items-center justify-center text-xl font-bold">
                        ✂
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 text-lg">{{ $service->name }}</h3>
                        <p class="text-gray-500 text-sm">~{{ $service->duration }} menit</p>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-2xl font-extrabold text-orange-600">
                        Rp {{ number_format($service->price, 0, ',', '.') }}
                    </span>
                    <a href="{{ route('booking.create') }}?service={{ $service->id }}"
                       class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-full text-sm font-semibold transition">
                        Pilih
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center text-gray-500 py-8">
                Belum ada layanan tersedia.
            </div>
        @endforelse
    </div>
</div>

{{-- How It Works --}}
<div class="bg-white rounded-2xl shadow p-6 mb-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-5 text-center">Cara Booking</h2>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
        <div>
            <div class="bg-orange-100 text-orange-600 rounded-full w-16 h-16 flex items-center justify-center text-3xl mx-auto mb-3">1️⃣</div>
            <h3 class="font-bold text-gray-700 mb-1">Pilih Layanan</h3>
            <p class="text-gray-500 text-sm">Pilih layanan yang kamu inginkan</p>
        </div>
        <div>
            <div class="bg-orange-100 text-orange-600 rounded-full w-16 h-16 flex items-center justify-center text-3xl mx-auto mb-3">2️⃣</div>
            <h3 class="font-bold text-gray-700 mb-1">Isi Data</h3>
            <p class="text-gray-500 text-sm">Nama, nomor HP, tanggal & waktu</p>
        </div>
        <div>
            <div class="bg-orange-100 text-orange-600 rounded-full w-16 h-16 flex items-center justify-center text-3xl mx-auto mb-3">3️⃣</div>
            <h3 class="font-bold text-gray-700 mb-1">Dapat Nomor Antrian</h3>
            <p class="text-gray-500 text-sm">Langsung dapat nomor antrian otomatis!</p>
        </div>
    </div>
</div>

@endsection
