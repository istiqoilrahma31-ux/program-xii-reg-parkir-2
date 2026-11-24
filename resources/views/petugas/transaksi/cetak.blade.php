@extends('layout.petugas')

@section('title', 'Cetak Struk Parkir')

@section('content')
<style>
    .area-struk {
        background: #e5e7eb;
        min-height: 85vh;
        padding: 35px 15px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }

    .struk {
        width: 320px;
        background: #fff;
        color: #111;
        padding: 25px 22px;
        font-family: 'Courier New', monospace;
        box-shadow: 0 8px 25px rgba(0,0,0,.15);
        border-radius: 3px;
    }

    .struk-header {
        text-align: center;
        border-bottom: 2px dashed #333;
        padding-bottom: 15px;
    }

    .logo-parkir {
        width: 48px;
        height: 48px;
        border: 2px solid #111;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        font-size: 23px;
    }

    .struk-header h3 {
        font-size: 21px;
        font-weight: bold;
        letter-spacing: 2px;
        margin: 0;
    }

    .struk-header p {
        font-size: 10px;
        margin: 5px 0 0;
    }

    .status-tiket {
        text-align: center;
        margin: 17px 0;
    }

    .status-tiket span {
        border: 1px solid #111;
        padding: 5px 18px;
        font-size: 11px;
        font-weight: bold;
        letter-spacing: 2px;
    }

    .nomor-tiket {
        text-align: center;
        margin: 15px 0;
    }

    .nomor-tiket small {
        display: block;
        font-size: 10px;
    }

    .nomor-tiket strong {
        font-size: 17px;
        letter-spacing: 1px;
    }

    .garis {
        border-top: 1px dashed #333;
        margin: 15px 0;
    }

    .detail {
        font-size: 12px;
    }

    .detail-baris {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin: 10px 0;
    }

    .detail-baris span:last-child {
        text-align: right;
        font-weight: bold;
    }

    .plat {
        text-align: center;
        border: 2px solid #111;
        padding: 12px 5px;
        margin: 18px 0;
    }

    .plat small {
        display: block;
        font-size: 10px;
        margin-bottom: 5px;
    }

    .plat strong {
        font-size: 23px;
        letter-spacing: 3px;
    }

    .barcode {
        text-align: center;
        margin: 20px 0 10px;
    }

    .barcode img {
        width: 190px;
        height: 55px;
        object-fit: contain;
    }

    .barcode p {
        font-size: 10px;
        letter-spacing: 2px;
        margin-top: 5px;
    }

    .footer-struk {
        text-align: center;
        border-top: 2px dashed #333;
        padding-top: 15px;
        font-size: 10px;
        line-height: 1.6;
    }

    .tombol-cetak {
        display: block;
        margin: 20px auto 0;
        padding: 10px 22px;
        border: none;
        border-radius: 7px;
        background: #111827;
        color: white;
        font-weight: bold;
    }

    @media print {
        @page {
            size: 80mm auto;
            margin: 0;
        }

        body {
            background: white !important;
        }

        .area-struk {
            background: white !important;
            padding: 0;
            min-height: auto;
        }

        .struk {
            width: 80mm;
            box-shadow: none;
            border-radius: 0;
            padding: 5mm;
        }

        .tombol-cetak {
            display: none;
        }
    }
</style>

<div class="area-struk">
    <div>
        <div class="struk">

            <div class="struk-header">
                <div class="logo-parkir">P</div>
                <h3>E-PARKIR</h3>
                <p>SISTEM PARKIR DIGITAL</p>
                <p>LAYANAN PARKIR KENDARAAN</p>
            </div>

            <div class="status-tiket">
                <span>BUKTI PARKIR</span>
            </div>

            <div class="nomor-tiket">
                <small>NOMOR TIKET</small>
                <strong>PK-20261116089</strong>
            </div>

            <div class="garis"></div>

            <div class="detail">
                <div class="detail-baris">
                    <span>Tanggal</span>
                    <span>16/11/2026</span>
                </div>

                <div class="detail-baris">
                    <span>Waktu Masuk</span>
                    <span>09:13:25</span>
                </div>

                <div class="detail-baris">
                    <span>Gerbang</span>
                    <span>Gate 01</span>
                </div>
            </div>

            <div class="plat">
                <small>NOMOR KENDARAAN</small>
                <strong>N 1234 ABC</strong>
            </div>

            <div class="detail">
                <div class="detail-baris">
                    <span>Jenis Kendaraan</span>
                    <span>Mobil</span>
                </div>

                <div class="detail-baris">
                    <span>Tarif per Jam</span>
                    <span>Rp5.000</span>
                </div>
            </div>

            <div class="garis"></div>

            <div class="barcode">
                <img
                    src="https://bwipjs-api.metafloor.com/?bcid=code128&text=PK20261116089&scale=2&height=12&includetext=false"
                    alt="Barcode tiket">
                <p>PK20261116089</p>
            </div>

            <div class="footer-struk">
                <strong>TERIMA KASIH</strong><br>
                Simpan tiket ini selama parkir.<br>
                Kehilangan tiket dikenakan biaya sesuai ketentuan.<br><br>
                *** SELAMAT JALAN ***
            </div>

        </div>

        <button class="tombol-cetak" onclick="window.print()">
            Cetak Struk
        </button>
    </div>
</div>
@endsection
