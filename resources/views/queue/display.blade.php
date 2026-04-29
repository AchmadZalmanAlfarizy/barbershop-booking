<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian – BarberShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta http-equiv="refresh" content="15">
    <style>
        body { background: #111827; }
        @keyframes pulse-big {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.03); }
        }
        .pulse-big { animation: pulse-big 2s infinite; }
    </style>
</head>
<body class="min-h-screen text-white font-sans">

    {{-- Header --}}
    <div class="bg-gray-900 border-b border-gray-700 px-8 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3 text-2xl font-bold text-orange-400">
            ✂️ BarberShop
        </div>
        <div class="text-right">
            <p class="text-gray-300 text-lg" id="clock"></p>
            <p class="text-gray-500 text-sm">{{ now()->format('d F Y') }}</p>
        </div>
    </div>

    <div class="p-8 grid grid-cols-1 lg:grid-cols-3 gap-8 min-h-[calc(100vh-80px)]">

        {{-- Current Queue --}}
        <div class="lg:col-span-2 flex flex-col items-center justify-center">
            <p class="text-gray-400 text-xl uppercase tracking-widest mb-4 font-semibold">
                Sedang Dilayani
            </p>

            @if($currentQueue)
                <div class="pulse-big bg-gradient-to-br from-orange-500 to-orange-700 rounded-3xl p-12 text-center shadow-2xl w-full max-w-md">
                    <p class="text-gray-100 text-lg font-medium mb-2">Nomor Antrian</p>
                    <p class="text-[12rem] font-black leading-none text-white drop-shadow-lg">
                        {{ str_pad($currentQueue->queue_number, 3, '0', STR_PAD_LEFT) }}
                    </p>
                    <div class="border-t border-orange-400 my-6"></div>
                    <p class="text-2xl font-bold text-orange-100">{{ $currentQueue->name }}</p>
                    <p class="text-orange-200 text-lg mt-1">{{ $currentQueue->service->name }}</p>
                </div>
            @else
                <div class="bg-gray-800 rounded-3xl p-12 text-center w-full max-w-md">
                    <p class="text-7xl mb-4">😴</p>
                    <p class="text-gray-400 text-2xl">Belum ada yang dipanggil</p>
                </div>
            @endif

            {{-- Done count --}}
            <div class="mt-8 flex gap-6 text-center">
                <div class="bg-gray-800 rounded-2xl px-8 py-4">
                    <p class="text-5xl font-black text-green-400">{{ $doneCount }}</p>
                    <p class="text-gray-400 text-sm mt-1">Sudah Selesai</p>
                </div>
                <div class="bg-gray-800 rounded-2xl px-8 py-4">
                    <p class="text-5xl font-black text-yellow-400">{{ $waitingList->count() }}</p>
                    <p class="text-gray-400 text-sm mt-1">Menunggu</p>
                </div>
            </div>
        </div>

        {{-- Waiting List --}}
        <div class="bg-gray-800 rounded-3xl p-6">
            <h2 class="text-xl font-bold text-gray-300 mb-5 uppercase tracking-wide">
                ⏳ Antrian Berikutnya
            </h2>

            @if($waitingList->isEmpty())
                <div class="text-center text-gray-600 py-12">
                    <p class="text-4xl mb-2">✅</p>
                    <p>Tidak ada antrian</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($waitingList as $i => $waiting)
                        <div class="flex items-center gap-4 rounded-2xl p-4
                            {{ $i === 0 ? 'bg-yellow-500/20 border border-yellow-500/40' : 'bg-gray-700' }}">
                            <div class="rounded-full w-14 h-14 flex items-center justify-center font-black text-xl shrink-0
                                {{ $i === 0 ? 'bg-yellow-500 text-gray-900' : 'bg-gray-600 text-gray-200' }}">
                                {{ str_pad($waiting->queue_number, 3, '0', STR_PAD_LEFT) }}
                            </div>
                            <div>
                                <p class="font-bold text-white text-lg leading-tight">{{ $waiting->name }}</p>
                                <p class="text-gray-400 text-sm">{{ $waiting->service->name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            document.getElementById('clock').textContent = time;
        }
        updateClock();
        setInterval(updateClock, 1000);
    </script>

</body>
</html>
