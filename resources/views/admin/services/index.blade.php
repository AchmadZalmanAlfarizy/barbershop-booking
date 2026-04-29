@extends('layouts.admin')

@section('title', 'Kelola Layanan')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-3xl font-extrabold text-gray-800">✂️ Kelola Layanan</h1>
        <p class="text-gray-500">Tambah, edit, atau hapus layanan barbershop</p>
    </div>
    <a href="{{ route('admin.services.create') }}"
       class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-xl font-semibold shadow transition">
        + Tambah Layanan
    </a>
</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">
    @if($services->isEmpty())
        <div class="text-center text-gray-400 py-16">
            <p class="text-4xl mb-2">✂️</p>
            <p class="mb-4">Belum ada layanan. Tambahkan layanan pertama!</p>
            <a href="{{ route('admin.services.create') }}"
               class="bg-orange-500 text-white px-5 py-2 rounded-xl font-semibold">
                + Tambah Layanan
            </a>
        </div>
    @else
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama Layanan</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Harga</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Durasi</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($services as $service)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-4 font-semibold text-gray-800">{{ $service->name }}</td>
                        <td class="px-4 py-4 text-orange-600 font-bold">
                            Rp {{ number_format($service->price, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-4 text-gray-600">{{ $service->duration }} menit</td>
                        <td class="px-4 py-4">
                            @if($service->is_active)
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">Aktif</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.services.edit', $service) }}"
                                   class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded-lg text-xs font-semibold transition">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                                      onsubmit="return confirm('Hapus layanan {{ $service->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-xs font-semibold transition">
                                        🗑 Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
