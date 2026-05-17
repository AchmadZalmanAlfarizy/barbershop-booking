<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Barber Booking') – BarberShop Premium</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Playfair Display', 'serif'],
                    },
                    colors: {
                        amber: {
                            400: '#fbbf24',
                            500: '#f59e0b',
                        },
                        barber: {
                            50:  '#fefce8',
                            100: '#fef9c3',
                            200: '#fef08a',
                            400: '#facc15',
                            500: '#eab308',
                            600: '#ca8a04',
                            700: '#a16207',
                            800: '#854d0e',
                            900: '#1c1917',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        slideUp: { '0%': { opacity: '0', transform: 'translateY(20px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #1c1917; }
        ::-webkit-scrollbar-thumb { background: #ca8a04; border-radius: 3px; }

        /* Navbar glassmorphism */
        .navbar-glass {
            background: rgba(28, 25, 23, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* Gold gradient text */
        .text-gold {
            background: linear-gradient(135deg, #fbbf24, #f59e0b, #d97706);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Card hover effects */
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        /* Glowing button */
        .btn-gold {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            transition: all 0.3s ease;
        }
        .btn-gold:hover {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
            transform: translateY(-1px);
        }

        /* Algorithm step connector */
        .step-connector::after {
            content: '';
            position: absolute;
            right: -50%;
            top: 50%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #f59e0b, #fbbf24);
        }
        @media (max-width: 768px) {
            .step-connector::after { display: none; }
        }

        /* Animated gradient background */
        .hero-gradient {
            background: linear-gradient(135deg, #0c0a09 0%, #1c1917 40%, #292524 70%, #1c1917 100%);
        }

        /* Badge pulse */
        .badge-live::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 9999px;
            background: rgba(34, 197, 94, 0.3);
            animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
        }
        @keyframes ping {
            75%, 100% { transform: scale(1.6); opacity: 0; }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-stone-950 min-h-screen font-sans text-stone-100">

    {{-- ═══ STICKY NAVBAR ═══ --}}
    <nav class="navbar-glass sticky top-0 z-50 border-b border-stone-800/60">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-3 flex items-center justify-between">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-9 h-9 bg-gradient-to-br from-amber-400 to-amber-600 rounded-lg flex items-center justify-center shadow-lg shadow-amber-500/30 group-hover:shadow-amber-500/50 transition">
                    <svg class="w-5 h-5 text-stone-900" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9.5 4a6.5 6.5 0 0 1 0 13H7v2h10v2H5v-4.27A6.5 6.5 0 0 1 9.5 4zm0 2a4.5 4.5 0 1 0 0 9 4.5 4.5 0 0 0 0-9z"/>
                    </svg>
                </div>
                <div class="leading-none">
                    <span class="text-lg font-black tracking-tight text-white">BARBER<span class="text-gold">SHOP</span></span>
                    <p class="text-xs text-stone-500 font-medium">Premium Grooming</p>
                </div>
            </a>

            {{-- Nav Links --}}
            <div class="hidden md:flex items-center gap-6 text-sm font-medium text-stone-400">
                <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors duration-200">Beranda</a>
                <a href="{{ route('home') }}#services" class="hover:text-amber-400 transition-colors duration-200">Layanan</a>
                <a href="{{ route('home') }}#cara-kerja" class="hover:text-amber-400 transition-colors duration-200">Cara Kerja</a>
                <a href="{{ route('booking.check') }}" class="hover:text-amber-400 transition-colors duration-200">Cek Antrian</a>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-2">
                <a href="{{ route('booking.check') }}"
                   class="hidden sm:flex items-center gap-1.5 text-stone-400 hover:text-amber-400 text-sm font-medium transition-colors duration-200 px-3 py-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cek Antrian
                </a>
                <a href="{{ route('admin.login') }}"
                   class="hidden sm:flex items-center gap-1.5 text-stone-500 hover:text-stone-300 text-sm font-medium transition-colors duration-200 px-3 py-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Admin
                </a>
                <a href="{{ route('booking.create') }}"
                   class="btn-gold text-stone-900 text-sm font-bold px-5 py-2.5 rounded-xl shadow-lg">
                    Booking Sekarang
                </a>
            </div>
        </div>
    </nav>

    {{-- ═══ FLASH MESSAGES ═══ --}}
    @if(session('success'))
        <div class="max-w-6xl mx-auto px-4 sm:px-6 mt-4 animate-fade-in">
            <div class="flex items-center gap-3 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-5 py-3.5 rounded-xl">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-6xl mx-auto px-4 sm:px-6 mt-4 animate-fade-in">
            <div class="flex items-center gap-3 bg-red-500/10 border border-red-500/30 text-red-400 px-5 py-3.5 rounded-xl">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    {{-- ═══ MAIN CONTENT ═══ --}}
    <main class="@yield('fullwidth', '') max-w-6xl mx-auto @yield('no-padding', 'px-4 sm:px-6') py-6">
        @yield('content')
    </main>

    {{-- ═══ FOOTER ═══ --}}
    <footer class="bg-stone-900 border-t border-stone-800 mt-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">

                {{-- Brand --}}
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-9 h-9 bg-gradient-to-br from-amber-400 to-amber-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-stone-900" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9.5 4a6.5 6.5 0 0 1 0 13H7v2h10v2H5v-4.27A6.5 6.5 0 0 1 9.5 4zm0 2a4.5 4.5 0 1 0 0 9 4.5 4.5 0 0 0 0-9z"/>
                            </svg>
                        </div>
                        <span class="text-lg font-black text-white">BARBER<span class="text-gold">SHOP</span></span>
                    </div>
                    <p class="text-stone-400 text-sm leading-relaxed">Sistem booking & antrian digital terbaik untuk barbershop modern. Mudah, cepat, dan transparan.</p>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="text-white font-bold mb-4 text-sm uppercase tracking-widest">Navigasi</h4>
                    <ul class="space-y-2 text-sm text-stone-400">
                        <li><a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('booking.create') }}" class="hover:text-amber-400 transition-colors">Booking Sekarang</a></li>
                        <li><a href="{{ route('booking.check') }}" class="hover:text-amber-400 transition-colors">Cek Status Antrian</a></li>
                        <li><a href="{{ route('queue.display') }}" class="hover:text-amber-400 transition-colors">Layar Antrian (TV)</a></li>
                    </ul>
                </div>

                {{-- Hours --}}
                <div>
                    <h4 class="text-white font-bold mb-4 text-sm uppercase tracking-widest">Jam Buka</h4>
                    <ul class="space-y-2 text-sm text-stone-400">
                        <li class="flex justify-between"><span>Senin – Jumat</span><span class="text-amber-400 font-medium">08:00 – 20:00</span></li>
                        <li class="flex justify-between"><span>Sabtu</span><span class="text-amber-400 font-medium">08:00 – 21:00</span></li>
                        <li class="flex justify-between"><span>Minggu</span><span class="text-amber-400 font-medium">09:00 – 19:00</span></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-stone-800 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-sm text-stone-500">
                <span>&copy; {{ date('Y') }} BarberShop Premium. Semua hak dilindungi.</span>
                <span>Sistem Antrian Digital v2.0</span>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
