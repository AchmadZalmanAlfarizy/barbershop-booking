<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') – BarberShop Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen font-sans">

    <nav class="bg-gray-900 text-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <span class="flex items-center gap-2 text-xl font-bold text-orange-400">
                ✂️ Admin Panel
            </span>
            <div class="flex items-center gap-4 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-orange-400 transition">Dashboard</a>
                <a href="{{ route('admin.services.index') }}" class="hover:text-orange-400 transition">Layanan</a>
                <a href="{{ route('admin.bookings') }}" class="hover:text-orange-400 transition">Semua Booking</a>
                <a href="{{ route('queue.display') }}" target="_blank" class="hover:text-orange-400 transition">TV Display</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-full text-sm transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    <div class="max-w-6xl mx-auto px-4 mt-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg mb-4">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('info'))
            <div class="bg-blue-100 border border-blue-400 text-blue-800 px-4 py-3 rounded-lg mb-4">
                ℹ️ {{ session('info') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg mb-4">
                ❌ {{ session('error') }}
            </div>
        @endif
    </div>

    <main class="max-w-6xl mx-auto px-4 py-6">
        @yield('content')
    </main>

</body>
</html>
