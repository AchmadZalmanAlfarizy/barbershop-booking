@extends('layouts.app')

@section('title', 'Booking')

@section('content')

<div class="max-w-2xl mx-auto">

    {{-- â•â•â• PAGE HEADER â•â•â• --}}
    <div class="text-center mb-8">
        <p class="text-amber-400 text-sm font-semibold uppercase tracking-widest mb-2">Reservasi Kursi</p>
        <h1 class="text-3xl sm:text-4xl font-black text-white mb-2">Buat <span class="text-gold">Booking</span></h1>
        <p class="text-stone-400">Isi form berikut. Tidak perlu buat akun &mdash; langsung dapat nomor antrian!</p>
    </div>

    {{-- â•â•â• ALGORITHM PROGRESS STEPS â•â•â• --}}
    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-5 mb-8">
        <div class="flex items-center justify-between relative">
            {{-- Connector --}}
            <div class="absolute top-4 left-[20%] right-[20%] h-px bg-stone-700 z-0"></div>
            <div class="absolute top-4 left-[20%] right-[40%] h-px bg-amber-500 z-0" id="progress-line"></div>

            @php
                $formSteps = [
                    ['label' => 'Pilih Layanan', 'icon' => 'M4 6h16M4 10h16M4 14h16'],
                    ['label' => 'Isi Data Diri', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                    ['label' => 'Pilih Waktu', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ];
            @endphp

            @foreach($formSteps as $idx => $fstep)
                <div class="flex flex-col items-center gap-1.5 z-10 flex-1">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $idx < 2 ? 'bg-amber-500 shadow-lg shadow-amber-500/30' : 'bg-stone-800 border border-stone-700' }} transition-all">
                        @if($idx < 2)
                            <svg class="w-4 h-4 text-stone-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        @else
                            <svg class="w-3.5 h-3.5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $fstep['icon'] }}"/>
                            </svg>
                        @endif
                    </div>
                    <span class="text-xs text-center {{ $idx < 2 ? 'text-amber-400 font-semibold' : 'text-stone-500' }}">{{ $fstep['label'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- â•â•â• FORM CARD â•â•â• --}}
    <div class="bg-stone-900 border border-stone-800 rounded-3xl overflow-hidden shadow-2xl">

        {{-- Form Header with Image --}}
        <div class="relative h-32 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1605497787557-a9e00046ee0b?w=800&auto=format&fit=crop&q=80"
                 alt="Barbershop" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-stone-900 via-stone-900/60 to-transparent"></div>
            <div class="absolute bottom-4 left-6">
                <p class="text-white font-bold text-lg">Form Booking</p>
                <p class="text-stone-400 text-xs">Isi semua field dengan benar</p>
            </div>
        </div>

        <div class="p-6 sm:p-8">

            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/30 text-red-400 rounded-xl p-4 mb-6">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold text-sm">Terdapat kesalahan:</span>
                    </div>
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('booking.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Row 1: Nama + HP --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-stone-300 font-semibold mb-2 text-sm">
                            Nama Lengkap <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   placeholder="Nama kamu..."
                                   required
                                   class="w-full bg-stone-800 border border-stone-700 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/20 text-white placeholder-stone-500 rounded-xl pl-10 pr-4 py-3 text-sm outline-none transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-stone-300 font-semibold mb-2 text-sm">
                            Nomor HP / WhatsApp <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                   placeholder="08xxxxxxxxxx"
                                   required
                                   class="w-full bg-stone-800 border border-stone-700 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/20 text-white placeholder-stone-500 rounded-xl pl-10 pr-4 py-3 text-sm outline-none transition-all">
                        </div>
                    </div>
                </div>

                {{-- Service --}}
                <div>
                    <label class="block text-stone-300 font-semibold mb-2 text-sm">
                        Pilih Layanan <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                        </div>
                        <select name="service_id" required
                                class="w-full bg-stone-800 border border-stone-700 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/20 text-white rounded-xl pl-10 pr-4 py-3 text-sm outline-none transition-all appearance-none">
                            <option value="" class="text-stone-500">-- Pilih Layanan --</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}"
                                    {{ old('service_id', request('service')) == $service->id ? 'selected' : '' }}
                                    class="text-white">
                                    {{ $service->name }} &mdash; Rp {{ number_format($service->price, 0, ',', '.') }} (~{{ $service->duration }} mnt)
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Date + Time --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-stone-300 font-semibold mb-2 text-sm">
                            Tanggal <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input type="date" name="booking_date"
                                   value="{{ old('booking_date', today()->toDateString()) }}"
                                   min="{{ today()->toDateString() }}"
                                   required
                                   class="w-full bg-stone-800 border border-stone-700 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/20 text-white rounded-xl pl-10 pr-4 py-3 text-sm outline-none transition-all [color-scheme:dark]">
                        </div>
                    </div>

                    <div>
                        <label class="block text-stone-300 font-semibold mb-2 text-sm">
                            Waktu <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <select name="booking_time" required
                                    class="w-full bg-stone-800 border border-stone-700 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/20 text-white rounded-xl pl-10 pr-4 py-3 text-sm outline-none transition-all appearance-none">
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
                            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Info Box --}}
                <div class="bg-amber-500/5 border border-amber-500/20 rounded-xl p-4 flex gap-3">
                    <svg class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="text-xs text-stone-400 leading-relaxed">
                        <strong class="text-amber-400 block mb-1">Setelah booking berhasil:</strong>
                        Kamu akan mendapat <strong class="text-white">nomor antrian otomatis</strong>. Pantau status antrian kapan saja menggunakan nomor HP yang kamu daftarkan. Datanglah saat nomor antrianmu hampir dipanggil.
                    </div>
                </div>

                <button type="submit"
                        class="w-full btn-gold text-stone-900 text-base font-bold py-4 rounded-xl shadow-lg shadow-amber-500/20">
                    Konfirmasi &amp; Dapat Nomor Antrian &rarr;
                </button>
            </form>
        </div>
    </div>

    <p class="text-center text-stone-500 text-sm mt-5">
        <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors flex items-center justify-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Beranda
        </a>
    </p>
</div>

@endsection
