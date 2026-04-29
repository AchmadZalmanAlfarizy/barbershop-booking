<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Barber Booking') – BarberShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        barber: {
                            50:  '#fff8f1',
                            100: '#feecdc',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen font-sans">

    {{-- Navbar --}}
    <nav class="bg-gray-900 text-white shadow-lg">
        <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-bold text-orange-400">
                ✂️ BarberShop
            </a>
            <div class="flex items-center gap-3 text-sm">
                <a href="{{ route('home') }}" class="hover:text-orange-400 transition hidden sm:inline">Beranda</a>
                <a href="{{ route('booking.check') }}" class="hover:text-orange-400 transition font-medium">🔍 Cek Antrian</a>
                <a href="{{ route('admin.login') }}" class="hover:text-gray-300 transition text-gray-300 font-medium">🔐 Admin</a>
                <a href="{{ route('booking.create') }}"
                   class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-full font-semibold transition">
                    Booking
                </a>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="max-w-5xl mx-auto px-4 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg">
                ✅ {{ session('success') }}
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-5xl mx-auto px-4 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg">
                ❌ {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main class="max-w-5xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-400 text-center py-4 mt-12 text-sm">
        &copy; {{ date('Y') }} BarberShop. Sistem Antrian Digital.
    </footer>

</body>
</html>
