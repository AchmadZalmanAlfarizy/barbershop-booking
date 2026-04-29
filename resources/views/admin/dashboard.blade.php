@extends('layouts.admin')

@section('content')

{{-- Modal ACC --}}
<div id="modal-acc" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4" onclick="if(event.target===this) closeModal()">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden">
        <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-5 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-xs font-semibold uppercase tracking-widest mb-1">ACC – Tandai Selesai</p>
                    <p class="text-3xl font-black" id="modal-queue-number">–</p>
                </div>
                <button onclick="closeModal()" class="text-green-200 hover:text-white text-3xl leading-none">&times;</button>
            </div>
        </div>
        <div class="px-6 pt-5 pb-2">
            <div class="bg-gray-50 rounded-2xl p-4 space-y-2 mb-5 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-400">Pelanggan</span>
                    <span class="font-semibold text-gray-800" id="modal-customer-name">–</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Layanan</span>
                    <span class="font-semibold text-gray-800" id="modal-service-name">–</span>
                </div>
                <div class="flex justify-between border-t border-gray-200 pt-2">
                    <span class="text-gray-400">Harga Layanan</span>
                    <span class="font-semibold text-orange-600" id="modal-service-price">–</span>
                </div>
            </div>
            <form id="form-acc" method="POST" action="">
                @csrf
                <input type="hidden" name="status" value="done">
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Jumlah Penjualan yang Dicatat
                    <span class="text-gray-400 font-normal text-xs ml-1">(bisa diubah)</span>
                </label>
                <div class="flex items-center border-2 border-gray-200 rounded-xl overflow-hidden focus-within:border-green-400 transition mb-1">
                    <span class="bg-gray-100 text-gray-500 font-semibold px-4 py-3 text-sm border-r border-gray-200">Rp</span>
                    <input type="number" id="modal-sale-amount" name="sale_amount" min="0" step="1000" placeholder="0" class="flex-1 px-4 py-3 text-gray-800 font-bold text-lg focus:outline-none bg-white">
                </div>
                <p class="text-gray-400 text-xs mb-5">💡 Isi 0 jika tidak ada transaksi online hari ini untuk antrian ini.</p>
                <div class="flex gap-3 pb-5">
                    <button type="button" onclick="closeModal()" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-xl transition text-sm">Batal</button>
                    <button type="submit" class="flex-1 bg-green-500 hover:bg-green-600 text-white font-extrabold py-3 px-6 rounded-xl shadow transition flex items-center justify-center gap-2"><span>✅</span> Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-3xl font-extrabold text-gray-800">Dashboard</h1>
        <p class="text-gray-500 text-sm">{{ now()->translatedFormat('l, d F Y') }}</p>
    </div>
    <form action="{{ route('admin.next') }}" method="POST">
        @csrf
        <button type="submit" class="bg-orange-500 hover:bg-orange-600 active:scale-95 text-white font-bold px-6 py-3 rounded-xl shadow-lg transition flex items-center gap-2">
            <span class="text-xl">📢</span> Panggil Berikutnya
        </button>
    </form>
</div>

{{-- Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    <div class="bg-white rounded-2xl shadow p-5 text-center border-t-4 border-blue-400">
        <p class="text-4xl font-black text-blue-600">{{ $totalToday }}</p>
        <p class="text-gray-400 text-xs mt-1 font-medium uppercase tracking-wide">Total Hari Ini</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-5 text-center border-t-4 border-yellow-400">
        <p class="text-4xl font-black text-yellow-500">{{ $waitingList->count() }}</p>
        <p class="text-gray-400 text-xs mt-1 font-medium uppercase tracking-wide">Menunggu</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-5 text-center border-t-4 border-green-400">
        <p class="text-4xl font-black text-green-600">{{ $doneToday }}</p>
        <p class="text-gray-400 text-xs mt-1 font-medium uppercase tracking-wide">Selesai</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-5 text-center border-t-4 border-orange-400">
        <p class="text-4xl font-black text-orange-500">{{ $currentQueue ? str_pad($currentQueue->queue_number, 3, '0', STR_PAD_LEFT) : '–' }}</p>
        <p class="text-gray-400 text-xs mt-1 font-medium uppercase tracking-wide">Antrian Aktif</p>
    </div>
    <div class="col-span-2 lg:col-span-1 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl shadow p-5 text-center">
        <p class="text-2xl font-black text-white leading-tight">Rp {{ number_format($todaySales ?? 0, 0, ',', '.') }}</p>
        <p class="text-green-100 text-xs mt-1 font-medium uppercase tracking-wide">Penjualan Online Hari Ini</p>
    </div>
</div>

{{-- Main Grid --}}
<div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
    {{-- Sedang Dilayani --}}
    <div class="lg:col-span-2 flex flex-col gap-4">
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">🔵 Sedang Dilayani</h2>
            @if($currentQueue)
                <div class="bg-blue-50 rounded-2xl p-6 text-center mb-4">
                    <p class="text-xs text-blue-400 font-semibold uppercase tracking-widest mb-1">No. Antrian</p>
                    <p class="text-7xl font-black text-blue-600 leading-none">{{ str_pad($currentQueue->queue_number, 3, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div class="space-y-2 mb-5">
                    <div class="flex items-center gap-3">
                        <div class="bg-gray-100 rounded-full w-10 h-10 flex items-center justify-center text-lg shrink-0">👤</div>
                        <div>
                            <p class="font-bold text-gray-800 text-lg leading-tight">{{ $currentQueue->name }}</p>
                            <p class="text-gray-400 text-sm">📱 {{ $currentQueue->phone }}</p>
                        </div>
                    </div>
                    <div class="bg-blue-50 rounded-xl px-4 py-2 flex items-center justify-between">
                        <span class="text-blue-700 font-semibold text-sm">{{ $currentQueue->service->name }}</span>
                        <span class="text-blue-400 text-sm">Rp {{ number_format($currentQueue->service->price, 0, ',', '.') }}</span>
                    </div>
                </div>
                <button type="button" onclick="openModal('{{ route('admin.booking.status', $currentQueue->id) }}', '{{ str_pad($currentQueue->queue_number, 3, '0', STR_PAD_LEFT) }}', '{{ addslashes($currentQueue->name) }}', '{{ addslashes($currentQueue->service->name) }}', {{ $currentQueue->service->price }})" class="w-full bg-green-500 hover:bg-green-600 active:scale-95 text-white text-lg font-extrabold py-4 rounded-2xl shadow-lg transition flex items-center justify-center gap-2">
                    <span class="text-2xl">✅</span> ACC – Tandai Selesai
                </button>
            @else
                <div class="bg-gray-50 rounded-2xl p-8 text-center">
                    <p class="text-5xl mb-3">😴</p>
                    <p class="text-gray-400 font-medium">Belum ada yang dilayani</p>
                    <p class="text-gray-300 text-sm mt-1">Tekan "Panggil Berikutnya" untuk mulai</p>
                </div>
            @endif
        </div>
        <div class="bg-white rounded-2xl shadow p-4 flex flex-col gap-1">
            <a href="{{ route('admin.bookings') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 transition text-gray-700 font-medium text-sm">
                <span>📋</span> Semua Booking Hari Ini
            </a>
            <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 transition text-gray-700 font-medium text-sm">
                <span>✂️</span> Kelola Layanan
            </a>
            <a href="{{ route('queue.display') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 transition text-gray-700 font-medium text-sm">
                <span>📺</span> Buka TV Display
            </a>
        </div>
    </div>

    {{-- Daftar Tunggu --}}
    <div class="lg:col-span-3 bg-white rounded-2xl shadow p-6 flex flex-col">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest">⏳ Daftar Tunggu</h2>
            <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1 rounded-full">{{ $waitingList->count() }} orang</span>
        </div>
        @if($waitingList->isEmpty())
            <div class="flex-1 flex flex-col items-center justify-center py-12 text-center">
                <p class="text-6xl mb-3">🎉</p>
                <p class="font-semibold text-gray-400">Tidak ada antrian yang menunggu!</p>
            </div>
        @else
            <div class="space-y-2 overflow-y-auto max-h-[540px] pr-1">
                @foreach($waitingList as $i => $item)
                    <div class="flex items-center gap-3 bg-gray-50 hover:bg-yellow-50 border border-transparent hover:border-yellow-200 rounded-xl p-3 transition group">
                        <span class="text-xs text-gray-300 font-bold w-5 text-center shrink-0">{{ $i + 1 }}</span>
                        <div class="bg-yellow-400 text-white rounded-xl w-12 h-12 flex items-center justify-center font-black text-base shrink-0 shadow-sm">{{ str_pad($item->queue_number, 3, '0', STR_PAD_LEFT) }}</div>
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-gray-800 text-sm truncate">{{ $item->name }}</p>
                            <p class="text-gray-400 text-xs">{{ $item->service->name }} &middot; {{ $item->booking_time }}</p>
                        </div>
                        <div class="flex gap-1 shrink-0 opacity-50 group-hover:opacity-100 transition">
                            <form action="{{ route('admin.booking.status', $item->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="in_progress">
                                <button type="submit" title="Langsung Layani" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-xs font-bold transition">Layani</button>
                            </form>
                            <button type="button" title="ACC Selesai" onclick="openModal('{{ route('admin.booking.status', $item->id) }}', '{{ str_pad($item->queue_number, 3, '0', STR_PAD_LEFT) }}', '{{ addslashes($item->name) }}', '{{ addslashes($item->service->name) }}', {{ $item->service->price }})" class="bg-green-100 hover:bg-green-200 text-green-700 px-3 py-2 rounded-lg text-xs font-bold transition">✅</button>
                            <form action="{{ route('admin.booking.status', $item->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" title="Batalkan" onclick="return confirm('Batalkan booking {{ addslashes($item->name) }}?')" class="bg-red-100 hover:bg-red-200 text-red-600 px-3 py-2 rounded-lg text-xs font-bold transition">✕</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
function openModal(actionUrl, queueNo, name, service, price) {
    document.getElementById('modal-queue-number').textContent = '#' + queueNo;
    document.getElementById('modal-customer-name').textContent = name;
    document.getElementById('modal-service-name').textContent = service;
    document.getElementById('modal-service-price').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(price);
    document.getElementById('form-acc').action = actionUrl;
    document.getElementById('modal-sale-amount').value = price;
    const modal = document.getElementById('modal-acc');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => document.getElementById('modal-sale-amount').select(), 100);
}

function closeModal() {
    const modal = document.getElementById('modal-acc');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script>

@endsection
