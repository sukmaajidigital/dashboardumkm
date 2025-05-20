<!DOCTYPE html>
<html>

<head>
    <title>Cetak QR Produk</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .qr-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .qr-item {
            text-align: center;
            border: 1px solid #ddd;
            padding: 10px;
        }

        .qr-item img {
            max-width: 100%;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print()">🖨 Cetak Halaman</button>
    </div>

    <h2>Daftar QR Produk</h2>

    <div class="qr-grid">
        @foreach ($produks as $produk)
            <div class="qr-item">
                <div>{!! QrCode::size(120)->generate('produk:' . $produk->id) !!}</div>
                <div style="margin-top: 10px;">
                    <strong>{{ $produk->name }}</strong><br>
                    <small>ID: {{ $produk->id }}</small><br>
                    <small>Harga: Rp {{ number_format($produk->harga, 0, ',', '.') }}</small>
                </div>
            </div>
        @endforeach
    </div>

</body>

</html>
