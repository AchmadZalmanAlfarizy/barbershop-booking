@extends('layouts.admin')

@section('title', 'Edit Layanan')

@section('content')

<div class="max-w-lg mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-gray-800">✏️ Edit Layanan</h1>
        <a href="{{ route('admin.services.index') }}" class="text-gray-500 hover:text-gray-700 text-sm">← Kembali</a>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        @if($errors->any())
            <div class="bg-red-50 border border-red-300 text-red-700 rounded-lg p-4 mb-5 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.services.update', $service) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Nama Layanan</label>
                <input type="text" name="name" value="{{ old('name', $service->name) }}"
                       required
                       class="w-full border-2 border-gray-200 focus:border-orange-400 rounded-xl px-4 py-3 text-lg outline-none transition">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $service->price) }}"
                       min="0" step="1000" required
                       class="w-full border-2 border-gray-200 focus:border-orange-400 rounded-xl px-4 py-3 text-lg outline-none transition">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Durasi (menit)</label>
                <input type="number" name="duration" value="{{ old('duration', $service->duration) }}"
                       min="5" max="300" required
                       class="w-full border-2 border-gray-200 focus:border-orange-400 rounded-xl px-4 py-3 text-lg outline-none transition">
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                       {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                       class="w-5 h-5 rounded border-gray-300 text-orange-500">
                <label for="is_active" class="text-gray-700 font-semibold">Layanan Aktif</label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-xl shadow transition">
                    💾 Simpan Perubahan
                </button>
                <a href="{{ route('admin.services.index') }}"
                   class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-xl transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
