<div class="flex justify-between py-2 border-b border-gray-100">
    <span class="text-gray-500 text-sm">Nama</span>
    <span class="font-semibold text-gray-800 text-sm">{{ $booking->name }}</span>
</div>
<div class="flex justify-between py-2 border-b border-gray-100">
    <span class="text-gray-500 text-sm">Layanan</span>
    <span class="font-semibold text-gray-800 text-sm">{{ $booking->service->name }}</span>
</div>
<div class="flex justify-between py-2 border-b border-gray-100">
    <span class="text-gray-500 text-sm">Harga</span>
    <span class="font-semibold text-orange-600 text-sm">Rp {{ number_format($booking->service->price, 0, ',', '.') }}</span>
</div>
<div class="flex justify-between py-2 border-b border-gray-100">
    <span class="text-gray-500 text-sm">Tanggal</span>
    <span class="font-semibold text-gray-800 text-sm">{{ $booking->booking_date->format('d F Y') }}</span>
</div>
<div class="flex justify-between py-2">
    <span class="text-gray-500 text-sm">Waktu</span>
    <span class="font-semibold text-gray-800 text-sm">{{ $booking->booking_time }}</span>
</div>
