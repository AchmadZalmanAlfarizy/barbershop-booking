@extends('layouts.app')

@section('title', 'Booking')

@section('content')

<div class="max-w-lg mx-auto">
    <div class="text-center mb-6">
        <h1 class="text-3xl font-extrabold text-gray-800">🗓 Buat Booking</h1>
        <p class="text-gray-500 mt-1">Isi form di bawah. Tidak perlu daftar akun!</p>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-6">

        @if($errors->any())
            <div class="bg-red-50 border border-red-300 text-red-700 rounded-lg p-4 mb-5">
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('booking.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Name --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2 text-lg">
                    👤 Nama Lengkap
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Masukkan nama kamu..."
                       required
                       class="w-full border-2 border-gray-200 focus:border-orange-400 rounded-xl px-4 py-3 text-lg outline-none transition">
            </div>

            {{-- Phone --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2 text-lg">
                    📱 Nomor HP / WhatsApp
                </label>
                <input type="tel"
                       name="phone"
                       value="{{ old('phone') }}"
                       placeholder="08xxxxxxxxxx"
                       required
                       class="w-full border-2 border-gray-200 focus:border-orange-400 rounded-xl px-4 py-3 text-lg outline-none transition">
            </div>

            {{-- Service --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2 text-lg">
                    ✂️ Pilih Layanan
                </label>
                <select name="service_id"
                        required
                        class="w-full border-2 border-gray-200 focus:border-orange-400 rounded-xl px-4 py-3 text-lg outline-none transition bg-white">
                    <option value="">-- Pilih Layanan --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}"
                            {{ old('service_id', request('service')) == $service->id ? 'selected' : '' }}>
                            {{ $service->name }} – Rp {{ number_format($service->price, 0, ',', '.') }}
                            (~{{ $service->duration }} mnt)
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Date --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2 text-lg">
                    📅 Tanggal
                </label>
                <input type="date"
                       name="booking_date"
                       value="{{ old('booking_date', today()->toDateString()) }}"
                       min="{{ today()->toDateString() }}"
                       required
                       class="w-full border-2 border-gray-200 focus:border-orange-400 rounded-xl px-4 py-3 text-lg outline-none transition">
            </div>

            {{-- Time --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2 text-lg">
                    🕐 Waktu
                </label>
                <select name="booking_time"
                        required
                        class="w-full border-2 border-gray-200 focus:border-orange-400 rounded-xl px-4 py-3 text-lg outline-none transition bg-white">
                    <option value="">-- Pilih Waktu --</option>
                    @foreach(range(8, 20) as $hour)
                        @foreach(['00', '30'] as $minute)
                            @php $time = sprintf('%02d:%s', $hour, $minute); @endphp
                            <option value="{{ $time }}" {{ old('booking_time') == $time ? 'selected' : '' }}>
                                {{ $time }}
                            </option>
                        @endforeach
                    @endforeach
                </select>
            </div>

            <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white text-xl font-bold py-4 rounded-xl shadow-lg transition mt-2">
                🚀 Konfirmasi Booking
            </button>
        </form>
    </div>

    <p class="text-center text-gray-400 text-sm mt-4">
        <a href="{{ route('home') }}" class="hover:text-orange-500 transition">← Kembali ke Beranda</a>
    </p>
</div>

@endsection
