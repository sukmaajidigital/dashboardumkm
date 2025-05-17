<x-printlayouts>
    <div class="max-w-3xl mx-auto p-6">
        <div class="flex justify-between items-start mb-6">
            <div class="w-1/2">
                <img src="{{ Storage::url($invoiceSetting->logo_invoice) }}" alt="Logo" class="w-32 mb-2">
                <h4 class="text-xl font-bold">{{ $invoiceSetting->name_invoice }}</h4>
                <p class="text-sm text-gray-600">
                    {{ $invoiceSetting->address }}<br>
                    Phone: {{ $invoiceSetting->phone }}<br>
                    Email: {{ $invoiceSetting->email }}
                </p>
            </div>
            <div class="text-right w-1/2">
                <h2 class="text-2xl font-bold">INVOICE</h2>
                @if ($penjualan->status === 'lunas')
                    <h3 class="text-success">
                        [PAID]
                    </h3>
                @else
                    <h3 class="text-error">
                        [UNPAID]
                    </h3>
                @endif
                <h5 class="text-sm font-semibold mt-10">NUMBER :</h5>
                <h5 class="text-sm font-bold">{{ $penjualan->invoicenumber }}</h5>
                <div class="mt-6 mb-6">
                    <h5 class="text-lg font-semibold">Invoice To :</h5>
                    <p class="text-sm text-gray-600">
                        {{ $penjualan->customer->nama_customer }}<br>
                        {{ $penjualan->customer->telepon }}<br>
                        {{ $penjualan->customer->alamat }}
                    </p>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto mb-6">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="p-2">NO</th>
                        <th class="p-2">Deskripsi Produk</th>
                        <th class="p-2">QTY</th>
                        <th class="p-2">Unit Price</th>
                        <th class="p-2">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualan->details as $index => $detail)
                        <tr class="border-b">
                            <td class="p-2">{{ $index + 1 }}</td>
                            <td class="p-2">{{ $detail->produk->name }}</td>
                            <td class="p-2">{{ $detail->qty }}</td>
                            <td class="p-2">Rp. {{ number_format($detail->harga, 0, ',', '.') }}</td>
                            <td class="p-2 text-right">Rp. {{ number_format($detail->sub_harga, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-right mt-4">
                <div class="mb-2 flex justify-end">
                    <div class="w-1/2 flex justify-between">
                        <span>SUBTOTAL:</span>
                        <span>Rp. {{ number_format($penjualan->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="mb-2 flex justify-end">
                    <div class="w-1/2 flex justify-between">
                        <span>DISKON:</span>
                        <span>Rp. {{ number_format($penjualan->diskon, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="font-bold flex justify-end">
                    <div class="w-1/2 flex justify-between">
                        <span>TOTAL:</span>
                        <span>Rp. {{ number_format($penjualan->last_total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-10 text-right">
            <p class="text-sm mb-1">Kudus, {{ $penjualan->tanggal }}</p>
            <div class="flex flex-col items-end">
                <img src="{{ Storage::url($invoiceSetting->ttd_image) }}" alt="TTD" class="w-32 mb-2">
                <p class="font-semibold">{{ $invoiceSetting->ttd_name }}</p>
                <p class="text-sm text-gray-600">{{ $invoiceSetting->ttd_position }}</p>
            </div>
        </div>
        <div class="mt-10 text-center text-sm ">
            <p>Jika ada pertanyaan seputar invoice ini bisa hubungi:</p>
            <p>{{ $invoiceSetting->email }}, {{ $invoiceSetting->phone }},</p>
            <p>{{ $invoiceSetting->address }}</p>
        </div>
    </div>
    <img src="{{ asset('storage/' . \App\Models\transaksi\InvoiceSetting::value('logo_invoice')) }}" alt="baground" class="absolute top-52 left-0 w-auto h-auto opacity-10">
    @push('script')
        <script>
            window.print();
            window.onafterprint = function() {
                window.close();
                window.location.href = "{{ route('penjualan.index') }}";
            }
        </script>
    @endpush
</x-printlayouts>
