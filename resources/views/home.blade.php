?@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- ═══════════════════════════════════════════════════════
     HERO SECTION – Full-screen with Unsplash background
═══════════════════════════════════════════════════════ --}}
<section class="relative overflow-hidden mb-12 min-h-screen md:min-h-[600px] flex items-center">

    {{-- Background Image from Unsplash (Full Width) --}}
    <div class="absolute inset-0">
        <img
            src="https://images.unsplash.com/photo-1503951914875-452162b0f3f1?w=1800&auto=format&fit=crop&q=90"
            alt="Barber sedang bekerja"
            class="w-full h-full object-cover"
            loading="eager"
        >
        <!-- Multi-layer gradient for sophisticated look -->
        <div class="absolute inset-0 bg-gradient-to-r from-stone-950/95 via-stone-900/60 to-stone-900/30"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-stone-950/40 via-transparent to-stone-950/40"></div>
        <!-- Radial gradient accent -->
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl"></div>
    </div>

    {{-- Decorative Elements --}}
    <div class="absolute top-20 left-10 w-2 h-2 bg-amber-400 rounded-full opacity-60 z-20"></div>
    <div class="absolute top-40 right-20 w-3 h-3 bg-amber-400/30 rounded-full opacity-40 z-20"></div>
    <div class="absolute bottom-32 left-1/4 w-1.5 h-1.5 bg-emerald-400/40 rounded-full opacity-50 z-20"></div>

    {{-- Hero Content - Horizontal Layout --}}
    <div class="relative z-10 w-full px-6 md:px-8 lg:px-16 py-12 md:py-16">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
            
            {{-- Left Content --}}
            <div class="fade-in-up">
                <!-- Status Badge -->
                <div class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500/15 to-amber-400/5 border border-amber-500/40 rounded-full px-4 py-2 mb-6 backdrop-blur-sm">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                    </span>
                    <span class="text-amber-300 text-xs font-semibold tracking-widest uppercase">Buka Sekarang</span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-5xl lg:text-6xl xl:text-7xl font-black text-white leading-tight mb-4 tracking-tight drop-shadow-lg">
                    Tampil<br>
                    <span class="text-gold gradient-wave">Percaya Diri</span><br>
                    <span class="text-4xl lg:text-5xl xl:text-6xl font-bold">Setiap Hari</span>
                </h1>

                <!-- Subheading -->
                <p class="text-base lg:text-lg text-stone-200 mb-8 leading-relaxed max-w-lg drop-shadow-md fade-in-up-delayed">
                    Booking barbershop premium dalam hitungan detik. Tidak perlu antri lama — sistem kami mengelola antrian secara otomatis dan transparan.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 fade-in-up-delayed" style="animation-delay: 0.4s;">
                    <a href="{{ route('booking.create') }}"
                       class="btn-gold text-stone-900 text-base lg:text-lg font-black px-8 lg:px-10 py-3 lg:py-4 rounded-2xl shadow-2xl shadow-amber-500/40 text-center hover:scale-105 transition-transform duration-300 group">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Booking Sekarang
                        </span>
                    </a>
                    <a href="{{ route('booking.check') }}"
                       class="flex items-center justify-center gap-3 bg-white/15 hover:bg-white/25 backdrop-blur-md border border-white/30 text-white text-base lg:text-lg font-semibold px-8 lg:px-10 py-3 lg:py-4 rounded-2xl transition-all duration-300 hover:scale-105 glass-effect group">
                        <svg class="w-5 h-5 lg:w-6 lg:h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Cek Antrian
                    </a>
                </div>
            </div>

            {{-- Right Content - Live Queue Card --}}
            <div class="hidden lg:flex justify-center float-animation">
                <div class="glass-effect rounded-3xl p-8 w-full max-w-sm shadow-2xl border-stone-700/30 hover:shadow-amber-500/20 fade-in-up-delayed" style="animation-delay: 0.2s;">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-2">
                        <span class="relative inline-flex h-3 w-3 badge-live">
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                        </span>
                        <span class="text-amber-300 text-xs font-bold uppercase tracking-widest">Live Queue</span>
                    </div>
                </div>
                @if($currentQueue)
                    <div class="text-center mb-6 space-y-3">
                        <p class="text-stone-400 text-xs mb-2 font-semibold">Sedang Dilayani</p>
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-amber-500/20 to-amber-500/5 rounded-2xl blur-xl"></div>
                            <p class="relative text-7xl font-black text-amber-400 drop-shadow-lg">{{ str_pad($currentQueue->queue_number, 3, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <p class="text-stone-200 text-sm mt-3 font-semibold truncate">{{ $currentQueue->name }}</p>
                        <p class="text-stone-500 text-xs mt-1">{{ $currentQueue->service->name }}</p>
                    </div>
                @else
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-amber-500/20 to-amber-500/5 rounded-full flex items-center justify-center mx-auto mb-3 border border-amber-500/30">
                            <svg class="w-9 h-9 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-stone-400 text-sm font-medium">Belum ada antrian</p>
                    </div>
                @endif
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-gradient-to-br from-amber-500/20 to-amber-600/10 border border-amber-500/30 rounded-2xl p-4 text-center hover:border-amber-500/50 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-amber-500/20">
                        <p class="text-3xl font-black text-amber-400">{{ $waitingCount }}</p>
                        <p class="text-stone-400 text-xs font-semibold mt-1">Menunggu</p>
                    </div>
                    <div class="bg-gradient-to-br from-emerald-500/20 to-emerald-600/10 border border-emerald-500/30 rounded-2xl p-4 text-center hover:border-emerald-500/50 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-emerald-500/20">
                        <p class="text-3xl font-black text-emerald-400">{{ $waitingCount > 0 ? $waitingCount * 30 : 0 }}</p>
                        <p class="text-stone-400 text-xs font-semibold mt-1">Menit Est.</p>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-gradient-to-br from-amber-500/20 to-amber-600/10 border border-amber-500/30 rounded-2xl p-4 text-center hover:border-amber-500/50 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-amber-500/20">
                            <p class="text-3xl font-black text-amber-400">{{ $waitingCount }}</p>
                            <p class="text-stone-400 text-xs font-semibold mt-1">Menunggu</p>
                        </div>
                        <div class="bg-gradient-to-br from-emerald-500/20 to-emerald-600/10 border border-emerald-500/30 rounded-2xl p-4 text-center hover:border-emerald-500/50 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-emerald-500/20">
                            <p class="text-3xl font-black text-emerald-400">{{ $waitingCount > 0 ? $waitingCount * 30 : 0 }}</p>
                            <p class="text-stone-400 text-xs font-semibold mt-1">Menit Est.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Mobile Queue Status --}}
<div class="lg:hidden mb-8">
    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-5">
        <div class="flex items-center gap-2 mb-3">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
            </span>
            <span class="text-stone-400 text-xs font-semibold uppercase tracking-widest">Status Antrian Live</span>
        </div>
        <div class="flex items-center justify-between">
            @if($currentQueue)
                <div>
                    <p class="text-stone-400 text-sm">Sedang dilayani</p>
                    <p class="text-3xl font-black text-amber-400">{{ str_pad($currentQueue->queue_number, 3, '0', STR_PAD_LEFT) }}</p>
                    <p class="text-stone-300 text-sm">{{ $currentQueue->name }}</p>
                </div>
            @else
                <p class="text-stone-400">Belum ada yang dilayani</p>
            @endif
            <div class="text-right">
                <p class="text-3xl font-bold text-amber-400">{{ $waitingCount }}</p>
                <p class="text-stone-500 text-sm">Menunggu</p>
            </div>
        </div>
    </div>
</div>

{{-- ═══ STATS BAR ═══ --}}
<div class="grid grid-cols-3 gap-4 mb-12">
    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-4 sm:p-6 text-center card-hover stagger-item group">
        <div class="w-10 h-10 bg-gradient-to-br from-amber-500/20 to-amber-500/5 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:shadow-lg group-hover:shadow-amber-500/40 transition-all">
            <svg class="w-5 h-5 text-amber-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <p class="text-xl sm:text-2xl font-black text-amber-400">500+</p>
        <p class="text-stone-400 text-xs sm:text-sm mt-1">Pelanggan Puas</p>
    </div>
    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-4 sm:p-6 text-center card-hover stagger-item group">
        <div class="w-10 h-10 bg-gradient-to-br from-amber-500/20 to-amber-500/5 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:shadow-lg group-hover:shadow-amber-500/40 transition-all">
            <svg class="w-5 h-5 text-amber-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
        </div>
        <p class="text-xl sm:text-2xl font-black text-amber-400">4.9&#9733;</p>
        <p class="text-stone-400 text-xs sm:text-sm mt-1">Rating Rata-rata</p>
    </div>
    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-4 sm:p-6 text-center card-hover stagger-item group">
        <div class="w-10 h-10 bg-gradient-to-br from-amber-500/20 to-amber-500/5 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:shadow-lg group-hover:shadow-amber-500/40 transition-all">
            <svg class="w-5 h-5 text-amber-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <p class="text-xl sm:text-2xl font-black text-amber-400">&lt;5 mnt</p>
        <p class="text-stone-400 text-xs sm:text-sm mt-1">Waktu Booking</p>
    </div>
</div>

{{-- ═══ SERVICES SECTION ═══ --}}
<section id="services" class="mb-14 scroll-mt-20">
    <div class="flex items-end justify-between mb-7">
        <div>
            <p class="text-amber-400 text-sm font-semibold uppercase tracking-widest mb-2">Layanan Kami</p>
            <h2 class="text-3xl font-black text-white">Pilih <span class="text-gold">Gaya</span> Terbaikmu</h2>
        </div>
        <a href="{{ route('booking.create') }}" class="hidden sm:flex items-center gap-1 text-amber-400 hover:text-amber-300 text-sm font-medium transition-colors">
            Lihat semua
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>

    @php
        $serviceImages = [
            'default' => 'https://images.unsplash.com/photo-1599351431202-1e0f0137899a?w=400&auto=format&fit=crop&q=80',
            'potong'  => 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?w=400&auto=format&fit=crop&q=80',
            'cukur'   => 'https://images.unsplash.com/photo-1621605815971-fbc98d665033?w=400&auto=format&fit=crop&q=80',
            'jenggot' => 'https://images.unsplash.com/photo-1621605815971-fbc98d665033?w=400&auto=format&fit=crop&q=80',
            'kumis'   => 'https://images.unsplash.com/photo-1621605815971-fbc98d665033?w=400&auto=format&fit=crop&q=80',
            'paket'   => 'https://images.unsplash.com/photo-1532710093739-9470acff878f?w=400&auto=format&fit=crop&q=80',
            'combo'   => 'https://images.unsplash.com/photo-1532710093739-9470acff878f?w=400&auto=format&fit=crop&q=80',
            'warna'   => 'https://images.unsplash.com/photo-1560869713-bf31640ac87b?w=400&auto=format&fit=crop&q=80',
            'cat'     => 'https://images.unsplash.com/photo-1560869713-bf31640ac87b?w=400&auto=format&fit=crop&q=80',
        ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($services as $service)
            @php
                $imgKey = 'default';
                foreach($serviceImages as $key => $url) {
                    if ($key !== 'default' && str_contains(strtolower($service->name), $key)) {
                        $imgKey = $key;
                        break;
                    }
                }
                $imgUrl = $serviceImages[$imgKey];
            @endphp
            <div class="group bg-stone-900 border border-stone-800 rounded-2xl overflow-hidden card-hover stagger-item glass-effect">
                <div class="relative h-44 overflow-hidden bg-gradient-to-br from-stone-800 to-stone-900">
                    <img src="{{ $imgUrl }}" alt="{{ $service->name }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-stone-900/95 via-stone-900/50 to-transparent"></div>
                    <div class="absolute bottom-3 left-4">
                        <span class="bg-gradient-to-r from-amber-500 to-amber-600 text-stone-900 text-xs font-black px-3 py-1.5 rounded-full shadow-lg shadow-amber-500/30 inline-block">
                            ~{{ $service->duration }} menit
                        </span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-white text-lg mb-1 group-hover:text-amber-400 transition-colors">{{ $service->name }}</h3>
                    <p class="text-stone-400 text-sm mb-4">Layanan profesional oleh barber berpengalaman</p>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-stone-500 mb-0.5">Mulai dari</p>
                            <p class="text-xl font-extrabold text-amber-400">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ route('booking.create') }}?service={{ $service->id }}"
                           class="btn-gold text-stone-900 px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-amber-500/20">
                            Pilih
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center text-stone-500 py-16">
                <svg class="w-12 h-12 mx-auto mb-3 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p>Belum ada layanan tersedia.</p>
            </div>
        @endforelse
    </div>
</section>

{{-- ═══ ALGORITHM / HOW IT WORKS ═══ --}}
<section id="cara-kerja" class="mb-14 scroll-mt-20">
    <div class="text-center mb-10">
        <p class="text-amber-400 text-sm font-semibold uppercase tracking-widest mb-2">Alur Pemesanan</p>
        <h2 class="text-3xl font-black text-white mb-3">Cara Kerja <span class="text-gold">Sistem Kami</span></h2>
        <p class="text-stone-400 max-w-xl mx-auto">Proses booking hingga mendapat layanan hanya membutuhkan beberapa langkah mudah. Sistem antrian kami bekerja secara otomatis dan adil.</p>
    </div>

    <div class="bg-stone-900 border border-stone-800 rounded-3xl p-6 sm:p-10 mb-6">

        {{-- 5-Step Flow --}}
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 md:gap-2 mb-10">
            @php
                $steps = [
                    ['num'=>'1','icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6','title'=>'Buka Website','desc'=>'Kunjungi halaman barbershop dari HP atau PC kamu'],
                    ['num'=>'2','icon'=>'M4 6h16M4 10h16M4 14h16M4 18h16','title'=>'Pilih Layanan','desc'=>'Tentukan jenis layanan beserta harga dan durasinya'],
                    ['num'=>'3','icon'=>'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z','title'=>'Isi Data Diri','desc'=>'Nama, nomor HP, pilih tanggal dan waktu kedatangan'],
                    ['num'=>'4','icon'=>'M7 20l4-16m2 16l4-16M6 9h14M4 15h14','title'=>'Dapat No. Antrian','desc'=>'Sistem otomatis memberi nomor antrian berurutan untukmu'],
                    ['num'=>'5','icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z','title'=>'Datang & Dilayani','desc'=>'Pantau antrian online, datang saat nomor hampir dipanggil'],
                ];
            @endphp

            @foreach($steps as $i => $step)
                <div class="flex md:flex-col items-center gap-4 md:gap-3 relative">
                    @if($i < 4)
                        <div class="hidden md:block absolute top-5 left-1/2 w-full h-px bg-gradient-to-r from-amber-500/40 to-amber-500/10 z-0"></div>
                    @endif
                    <div class="relative z-10 flex-shrink-0">
                        <div class="w-11 h-11 {{ $i === 4 ? 'bg-gradient-to-br from-emerald-500 to-emerald-600' : 'bg-gradient-to-br from-amber-500 to-amber-600' }} rounded-xl flex items-center justify-center shadow-lg mx-auto">
                            <svg class="w-5 h-5 text-stone-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $step['icon'] }}"/>
                            </svg>
                        </div>
                        <span class="absolute -top-1.5 -right-1.5 w-4 h-4 bg-stone-950 border border-amber-500 rounded-full text-amber-400 text-xs font-black flex items-center justify-center">{{ $step['num'] }}</span>
                    </div>
                    <div class="text-left md:text-center">
                        <h4 class="text-white font-bold text-sm mb-0.5">{{ $step['title'] }}</h4>
                        <p class="text-stone-400 text-xs leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Algorithm Explanation Cards --}}
        <div class="border-t border-stone-800 pt-8">
            <h3 class="text-white font-bold text-center text-lg mb-6">
                Bagaimana Algoritma Antrian Bekerja?
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                {{-- FIFO --}}
                <div class="bg-stone-800/60 rounded-2xl p-5 border border-stone-700/40">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 bg-blue-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                        <h4 class="text-white font-bold text-sm">Antrian FIFO</h4>
                    </div>
                    <p class="text-stone-400 text-xs leading-relaxed mb-3">Sistem menggunakan <strong class="text-blue-400">First In, First Out</strong> — siapa booking lebih dulu, dilayani lebih dulu. Tidak ada prioritas, semua diperlakukan adil.</p>
                    <div class="flex items-center gap-1 text-xs">
                        <span class="bg-stone-700 text-stone-300 px-2 py-1 rounded font-mono">001</span>
                        <svg class="w-3 h-3 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="bg-stone-700 text-stone-300 px-2 py-1 rounded font-mono">002</span>
                        <svg class="w-3 h-3 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="bg-stone-700 text-stone-300 px-2 py-1 rounded font-mono">003</span>
                        <span class="text-blue-400 ml-1">= urut</span>
                    </div>
                </div>

                {{-- Auto Numbering --}}
                <div class="bg-stone-800/60 rounded-2xl p-5 border border-stone-700/40">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 bg-amber-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                            </svg>
                        </div>
                        <h4 class="text-white font-bold text-sm">Nomor Otomatis</h4>
                    </div>
                    <p class="text-stone-400 text-xs leading-relaxed mb-3">Tiap booking menghasilkan <strong class="text-amber-400">nomor unik harian</strong> yang dihitung otomatis. Nomor di-reset setiap hari pukul 00:00, mulai dari 001.</p>
                    <div class="bg-stone-900 rounded-lg p-2 font-mono text-xs text-stone-400">
                        <span class="text-stone-500">// Algoritma:</span><br>
                        <span class="text-amber-400">no_antrian</span> = max_hari_ini + 1
                    </div>
                </div>

                {{-- Real-time Status --}}
                <div class="bg-stone-800/60 rounded-2xl p-5 border border-stone-700/40">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 bg-emerald-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h4 class="text-white font-bold text-sm">Status Real-time</h4>
                    </div>
                    <p class="text-stone-400 text-xs leading-relaxed mb-3">Pantau posisi antrian kapan saja. Sistem menghitung <strong class="text-emerald-400">estimasi waktu tunggu</strong> berdasarkan jumlah orang di depanmu.</p>
                    <div class="space-y-1.5">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-amber-400 rounded-full flex-shrink-0"></span>
                            <span class="text-xs text-stone-400"><strong class="text-amber-400">Menunggu</strong> — belum dipanggil</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-blue-400 rounded-full animate-pulse flex-shrink-0"></span>
                            <span class="text-xs text-stone-400"><strong class="text-blue-400">Diproses</strong> — sedang dilayani barber</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-emerald-400 rounded-full flex-shrink-0"></span>
                            <span class="text-xs text-stone-400"><strong class="text-emerald-400">Selesai</strong> — proses tuntas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CTA Banner --}}
    <div class="relative bg-gradient-to-r from-amber-600 to-amber-500 rounded-2xl overflow-hidden p-8 text-center">
        <div class="absolute inset-0 opacity-10">
            <img src="https://images.unsplash.com/photo-1605497787557-a9e00046ee0b?w=1200&auto=format&fit=crop&q=60"
                 class="w-full h-full object-cover" alt="">
        </div>
        <div class="relative z-10">
            <h3 class="text-stone-900 font-black text-2xl mb-2">Siap Tampil Keren Hari Ini?</h3>
            <p class="text-stone-800/80 mb-5">Booking sekarang dan nikmati kemudahan antrian digital.</p>
            <a href="{{ route('booking.create') }}"
               class="inline-block bg-stone-900 hover:bg-stone-800 text-white font-bold px-8 py-3 rounded-xl shadow-lg transition-all duration-200">
                Booking Gratis Sekarang &rarr;
            </a>
        </div>
    </div>
</section>

{{-- ═══ GALLERY ═══ --}}
<section class="mb-14">
    <div class="text-center mb-7">
        <p class="text-amber-400 text-sm font-semibold uppercase tracking-widest mb-2">Suasana Kami</p>
        <h2 class="text-3xl font-black text-white">Galeri <span class="text-gold">Barbershop</span></h2>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 auto-rows-[180px]">
        <div class="group relative md:col-span-2 md:row-span-2 overflow-hidden rounded-2xl bg-stone-800">
            <img src="https://images.unsplash.com/photo-1605497787557-a9e00046ee0b?w=600&auto=format&fit=crop&q=80"
                 alt="Barbershop interior" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
        </div>
        <div class="group relative overflow-hidden rounded-2xl bg-stone-800">
            <img src="https://images.unsplash.com/photo-1503951914875-452162b0f3f1?w=400&auto=format&fit=crop&q=80"
                 alt="Barber at work" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
        </div>
        <div class="group relative overflow-hidden rounded-2xl bg-stone-800">
            <img src="https://images.unsplash.com/photo-1621605815971-fbc98d665033?w=400&auto=format&fit=crop&q=80"
                 alt="Beard trim" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
        </div>
        <div class="group relative overflow-hidden rounded-2xl bg-stone-800">
            <img src="https://images.unsplash.com/photo-1599351431202-1e0f0137899a?w=400&auto=format&fit=crop&q=80"
                 alt="Barber tools" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
        </div>
        <div class="group relative overflow-hidden rounded-2xl bg-stone-800">
            <img src="https://images.unsplash.com/photo-1532710093739-9470acff878f?w=400&auto=format&fit=crop&q=80"
                 alt="Hair styling" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
        </div>
    </div>
</section>

@endsection
