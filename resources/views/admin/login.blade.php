<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login – BarberShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center">

<div class="w-full max-w-sm mx-auto">
    <div class="text-center mb-8">
        <div class="text-6xl mb-3">✂️</div>
        <h1 class="text-3xl font-extrabold text-white">BarberShop Admin</h1>
        <p class="text-gray-400 mt-1">Masuk ke panel admin</p>
    </div>

    <div class="bg-white rounded-2xl shadow-2xl p-8">

        @if($errors->has('login'))
            <div class="bg-red-50 border border-red-300 text-red-700 rounded-lg p-3 mb-5 text-sm">
                ❌ {{ $errors->first('login') }}
            </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Email / Admin ID</label>
                <input type="text"
                       name="username"
                       value="{{ old('username') }}"
                       placeholder="admin"
                       required
                       autocomplete="username"
                       class="w-full border-2 border-gray-200 focus:border-orange-400 rounded-xl px-4 py-3 text-lg outline-none transition">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password"
                       name="password"
                       placeholder="••••••••"
                       required
                       autocomplete="current-password"
                       class="w-full border-2 border-gray-200 focus:border-orange-400 rounded-xl px-4 py-3 text-lg outline-none transition">
            </div>

            <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white text-xl font-bold py-3 rounded-xl shadow transition">
                🔐 Masuk
            </button>
        </form>
    </div>

    <p class="text-center text-gray-500 text-sm mt-6">
        <a href="{{ route('home') }}" class="hover:text-orange-400 transition">← Ke halaman customer</a>
    </p>
</div>

</body>
</html>
