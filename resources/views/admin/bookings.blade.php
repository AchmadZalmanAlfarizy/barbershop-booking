@extends('layouts.admin')

@section('title', 'Semua Booking')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-3xl font-extrabold text-gray-800">📋 Semua Booking</h1>
        <p class="text-gray-500">Data booking berdasarkan tanggal</p>
    </div>
    <a href="{{ route('admin.dashboard') }}"
       class="text-gray-500 hover:text-gray-700 text-sm">← Dashboard</a>
</div>

{{-- Date Filter --}}
<div class="bg-white rounded-2xl shadow p-4 mb-6">
    <form method="GET" action="{{ route('admin.bookings') }}" class="flex items-center gap-3">
        <label class="font-semibold text-gray-700">Tanggal:</label>
        <input type="date" name="date" value="{{ $date }}"
               class="border-2 border-gray-200 focus:border-orange-400 rounded-xl px-3 py-2 outline-none transition">
        <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl font-semibold transition text-sm">
            Tampilkan
        </button>
    </form>
</div>

{{-- Table --}}
<div class="bg-white rounded-2xl shadow overflow-hidden">
    @if($bookings->isEmpty())
        <div class="text-center text-gray-400 py-16">
            <p class="text-4xl mb-2">📭</p>
            <p>Tidak ada booking pada tanggal ini.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">No</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">HP</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Layanan</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Waktu</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($bookings as $booking)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 font-black text-gray-700 text-lg">
                                {{ str_pad($booking->queue_number, 3, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-4 py-3 font-semibold text-gray-800">{{ $booking->name }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $booking->phone }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $booking->service->name }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $booking->booking_time }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $colors = [
                                        'waiting'     => 'bg-yellow-100 text-yellow-700',
                                        'in_progress' => 'bg-blue-100 text-blue-700',
                                        'done'        => 'bg-green-100 text-green-700',
                                        'cancelled'   => 'bg-red-100 text-red-700',
                                    ];
                                    $color = $colors[$booking->status] ?? 'bg-gray-100 text-gray-700';
                                @endphp
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $color }}">
                                    {{ $booking->status_label }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex gap-1 flex-wrap">
                                    @foreach(['waiting' => 'Tunggu', 'in_progress' => 'Layani', 'done' => 'Selesai', 'cancelled' => 'Batal'] as $status => $label)
                                        @if($booking->status !== $status)
                                            <form action="{{ route('admin.booking.status', $booking->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="{{ $status }}">
                                                <button type="submit"
                                                        class="text-xs px-2 py-1 rounded-lg font-semibold transition
                                                               {{ $status === 'cancelled' ? 'bg-red-100 text-red-600 hover:bg-red-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                                    {{ $label }}
                                                </button>
                                            </form>
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection
