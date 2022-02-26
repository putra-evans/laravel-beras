<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Penjualan</title>
    <style>
        .head-wrapper table tr td p {
            margin: 0;
            padding: 0;
        }

        .content-wrapper table tr td {
            font-size: 8pt !important;
            padding: 5px;
        }

        #table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 10px;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
            font-size: 10px;
            /* background-color: #4CAF50; */
            color: black;
        }

        #BiodataTbl {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            font-size: 10px;
            color: black;
            width: 100%;
            padding-top: 10px;
            padding-bottom: 10px;

        }

    </style>
</head>

<body>
    <div class="head-wrapper">
        <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tbody>
                <tr>
                    <td valign="top" align="center" valign="center">
                        <p style="font-size: 19px;">
                            <strong>Toko Beras H. Danir</strong>
                        </p>
                        {{-- <p style="font-size: 20px;">
                            <strong><span>DINAS KOPERASI, USAHA KECIL DAN MENENGAH</span></strong>
                        </p> --}}
                        <p style="color: black; font:smaller;margin-top: 10px;">Jl. Sparman No.88 Lolong, Padang,
                            <br>Kota Padang, Sumatera Barat
                    </td>

                </tr>
            </tbody>
        </table>
        <hr style="margin-top: 3px;height:1px;background-color: black;">
        <hr style="margin-top: 1px;">
    </div>
    <br>
    <div style="text-align: center">
        <span style="text-align: center;">Laporan Penjualan {{ $bulan }}</span>
        <br><br>
    </div>
    <table id="table">
        <thead>
            <tr>
                <th width="5%" class="font-weight-bold text-center">No</th>
                <th width="20%" class="font-weight-bold text-center">Nama Produk</th>
                <th width="15%" class="font-weight-bold text-center">Jumlah Harga</th>
                <th width="15%" class="font-weight-bold text-center">Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php $totals = 0; ?>
            @foreach ($penjualan as $key => $pecah)
                <tr>
                    <td style="text-align: center">{{ $key + 1 }}</td>
                    <td>{{ $pecah->judul_produk }}</td>
                    <td style="text-align: center">{{ $pecah->qty }} Kg * Rp.
                        {{ number_format($pecah->harga_produk) }}</td>
                    <td style="text-align: center">Rp. {{ number_format($pecah->total_harga) }}</td>
                </tr>
                <?php $totals += $pecah->total_harga; ?>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="font-style: bold;text-align: left">Total Pendapatan</td>
                <td style="font-style: bold;text-align: center">Rp. {{ number_format($totals) }}</td>
            </tr>
        </tfoot>
    </table>
    <br>
    <div style="padding-left: 500px;font-size: 12px;">
        <p style="text-align: center;font-size: 12px;">Padang, {{ $sekarang }}</p>
        <p style="text-align: center;font-size: 12px;"> KEPALA</p>
        <br><br><br>
        <p style="text-align: center;font-weight: bold;"><strong>H. Danir</strong> <br> <strong>Toko Beras H.
                Danir</strong></p>
    </div>


</body>

</html>
