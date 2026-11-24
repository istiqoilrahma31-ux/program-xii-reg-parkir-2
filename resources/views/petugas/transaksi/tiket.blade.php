
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Parkir - E-Parkir Kabasa</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            background: #e9e9e9;
            font-family: Arial, sans-serif;
            color: #111;
        }

        .struk {
            width: 58mm;
            min-height: 100mm;
            margin: auto;
            padding: 15px 12px;
            background: white;
            box-shadow: 0 3px 15px #aaa;
        }

        .center {
            text-align: center;
        }

        .logo {
            font-size: 25px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .subtitle {
            font-size: 10px;
            margin-top: 4px;
        }

        .garis {
            border-top: 1px dashed #111;
            margin: 12px 0;
        }

        .judul {
            font-size: 13px;
            font-weight: bold;
            margin: 10px 0;
        }

        .plat {
            font-size: 21px;
            font-weight: bold;
            border: 2px solid black;
            padding: 8px 3px;
            margin: 10px 0;
            text-align: center;
        }

        .detail {
            font-size: 11px;
            line-height: 1.8;
        }

        .baris {
            display: flex;
            justify-content: space-between;
            gap: 5px;
        }

        .baris span:last-child {
            text-align: right;
            font-weight: bold;
        }

        .footer {
            font-size: 10px;
            line-height: 1.6;
        }

        .tombol {
            display: block;
            width: 58mm;
            margin: 15px auto;
            padding: 12px;
            border: none;
            background: #17132c;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
        }

        @media print {
            @page {
                size: 58mm auto;
                margin: 0;
            }

            body {
                padding: 0;
                background: white;
            }

            .struk {
                width: 58mm;
                min-height: auto;
                box-shadow: none;
                margin: 0;
            }

            .tombol {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="struk">

        <div class="center">
            <div class="logo">E-PARKIR</div>
            <div class="subtitle">KABASA PARKING SYSTEM</div>
            <div class="subtitle">BUKTI KENDARAAN MASUK</div>
        </div>

        <div class="garis"></div>

        <div class="center judul">
            TIKET PARKIR
        </div>

        <div class="plat">
            {{ $kendaraan->plat_nomor }}
        </div>

        <div class="detail">

            <div class="baris">
                <span>No. Tiket</span>
                <span>{{ $transaksi->id_transaksi }}</span>
            </div>

            <div class="baris">
                <span>Jenis</span>
                <span>{{ ucfirst($kendaraan->jenis_kendaraan) }}</span>
            </div>

            <div class="baris">
                <span>Warna</span>
                <span>{{ $kendaraan->warna }}</span>
            </div>

            <div class="baris">
                <span>Pemilik</span>
                <span>{{ $kendaraan->pemilik }}</span>
            </div>

            <div class="baris">
                <span>Area</span>
                <span>{{ $area->nama_area }}</span>
            </div>

            <div class="baris">
                <span>Waktu Masuk</span>
                <span>
                    {{ \Carbon\Carbon::parse($transaksi->waktu_masuk)->format('d/m/Y H:i') }}
                </span>
            </div>

            <div class="baris">
                <span>Petugas</span>
                <span>{{ $petugas }}</span>
            </div>

        </div>

        <div class="garis"></div>

        <div class="center footer">
            <strong>SIMPAN TIKET INI</strong><br>
            Tunjukkan tiket saat keluar parkir.<br>
            Terima kasih telah menggunakan<br>
            layanan E-PARKIR KABASA.
        </div>

        <div class="garis"></div>

        <div class="center footer">
            *** SELAMAT PARKIR ***
        </div>

    </div>

    <button class="tombol" onclick="window.print()">
        CETAK TIKET PARKIR
    </button>

</body>
</html>
