@extends('layouts.app')

@section('title', 'Konfirmasi Booking')

@section('content')

<div class="max-w-lg mx-auto">

    {{-- Success Animation --}}
    <div class="text-center mb-8">
        <div class="relative inline-flex mb-5">
            <div class="w-24 h-24 bg-emerald-500/20 rounded-full flex items-center justify-center">
                <div class="w-16 h-16 bg-emerald-500/30 rounded-full flex items-center justify-center">
                    <svg class="w-9 h-9 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>
            <span class="absolute -top-1 -right-1 w-7 h-7 bg-amber-500 rounded-full flex items-center justify-center text-stone-900 text-lg">
                &#10003;
            </span>
        </div>
        <h1 class="text-3xl font-black text-white mb-2">Booking <span class="text-gold">Berhasil!</span></h1>
        <p class="text-stone-400">Simpan nomor antrian kamu di bawah ini. Pantau status kapan saja!</p>
    </div>

    {{-- Queue Number Card --}}
    <div class="relative bg-gradient-to-br from-amber-500 to-amber-600 rounded-3xl p-8 shadow-2xl shadow-amber-500/20 mb-6 overflow-hidden text-center">
        <div class="absolute inset-0 opacity-5">
            <img src="https://images.unsplash.com/photo-1605497787557-a9e00046ee0b?w=600&auto=format&fit=crop&q=50"
                 class="w-full h-full object-cover" alt="">
        </div>
        <div class="relative z-10">
            <p class="text-amber-900/70 text-xs font-bold uppercase tracking-[0.2em] mb-3">Nomor Antrian Kamu</p>
            <p class="text-8xl font-black text-stone-900 leading-none mb-3">{{ str_pad($booking->queue_number, 3, '0', STR_PAD_LEFT) }}</p>
            <div class="flex items-center justify-center gap-2 text-amber-900/80 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $booking->booking_date->format('d F Y') }}
                <span class="opacity-50">&bull;</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ $booking->booking_time }}
            </div>
        </div>
    </div>

    {{-- Booking Details --}}
    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-5 mb-5">
        <h3 class="text-stone-400 text-xs font-bold uppercase tracking-widest mb-4">Detail Booking</h3>
        <div class="space-y-3">
            @php
                $details = [
                    ['label' => 'Nama', 'value' => $booking->name, 'color' => 'text-white'],
                    ['label' => 'Nomor HP', 'value' => $booking->phone, 'color' => 'text-white'],
                    ['label' => 'Layanan', 'value' => $booking->service->name, 'color' => 'text-white'],
                    ['label' => 'Harga', 'value' => 'Rp ' . number_format($booking->service->price, 0, ',', '.'), 'color' => 'text-amber-400 font-bold'],
                    ['label' => 'Tanggal', 'value' => $booking->booking_date->format('d F Y'), 'color' => 'text-white'],
                    ['label' => 'Waktu', 'value' => $booking->booking_time, 'color' => 'text-white'],
                ];
            @endphp
            @foreach($details as $detail)
                <div class="flex items-center justify-between py-2 border-b border-stone-800/60 last:border-0">
                    <span class="text-stone-400 text-sm">{{ $detail['label'] }}</span>
                    <span class="font-semibold text-sm {{ $detail['color'] }}">{{ $detail['value'] }}</span>
                </div>
            @endforeach

            {{-- Wait time --}}
            <div class="flex items-center justify-between py-2">
                <span class="text-stone-400 text-sm">Estimasi Tunggu</span>
                @if($estimatedWait > 0)
                    <span class="font-bold text-sm text-yellow-400 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        ~{{ $estimatedWait }} menit
                    </span>
                @else
                    <span class="font-bold text-sm text-emerald-400 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3l14 9-14 9V3z"/>
                        </svg>
                        Langsung Dilayani!
                    </span>
                @endif
            </div>
        </div>
    </div>

    {{-- What's Next: Algorithm Steps --}}
    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-5 mb-5">
        <h3 class="text-stone-400 text-xs font-bold uppercase tracking-widest mb-4">Langkah Selanjutnya</h3>
        <div class="space-y-3">
            @php
                $nextSteps = [
                    ['icon' => 'M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z', 'text' => 'Simpan atau screenshot nomor antrian ini', 'color' => 'bg-amber-500/10 text-amber-400'],
                    ['icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'text' => 'Pantau status antrian kapan saja di halaman Cek Antrian', 'color' => 'bg-blue-500/10 text-blue-400'],
                    ['icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z', 'text' => 'Datanglah ke barbershop saat nomor antrianmu hampir dipanggil', 'color' => 'bg-emerald-500/10 text-emerald-400'],
                ];
            @endphp
            @foreach($nextSteps as $i => $ns)
                <div class="flex items-start gap-3">
                    <div class="w-7 h-7 {{ $ns['color'] }} rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $ns['icon'] }}"/>
                        </svg>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="text-stone-600 text-xs font-bold mt-0.5">{{ $i + 1 }}.</span>
                        <span class="text-stone-300 text-sm">{{ $ns['text'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Action Buttons --}}
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

    <div class="space-y-3">
        <a href="https://wa.me/?text={{ $waMessage }}" target="_blank"
           class="flex items-center justify-center gap-2 w-full bg-emerald-500 hover:bg-emerald-400 text-white text-sm font-bold py-3.5 rounded-xl shadow-lg transition-all duration-200">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            Bagikan via WhatsApp
        </a>

        <a href="{{ route('booking.check') }}?phone={{ urlencode($booking->phone) }}"
           class="flex items-center justify-center gap-2 w-full bg-stone-800 hover:bg-stone-700 border border-stone-700 text-white text-sm font-semibold py-3.5 rounded-xl transition-all duration-200">
            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Cek Status Antrian
        </a>

        <a href="{{ route('home') }}"
           class="flex items-center justify-center gap-2 w-full text-stone-500 hover:text-stone-300 text-sm font-semibold py-3 rounded-xl transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Beranda
        </a>
    </div>
</div>

@endsection
