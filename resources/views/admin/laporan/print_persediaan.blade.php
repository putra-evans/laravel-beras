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
                        <p style="color: black; font:smaller;margin-top: 10px;">Jl. Pasir Sebelah No.41, Pasie Nan Tigo,
                            Kec. Koto Tangah <br>Kota Padang, Sumatera Barat 25586
                    </td>

                </tr>
            </tbody>
        </table>
        <hr style="margin-top: 3px;height:1px;background-color: black;">
        <hr style="margin-top: 1px;">
    </div>
    <br>
    <div style="text-align: center">
        <span style="text-align: center;">Laporan Persediaan {{$bulan}}</span>
        <br><br>
    </div>
    <table id="table">
        <thead>
            <tr>
                <th width="5%" class="font-weight-bold text-center">No</th>
                <th width="20%" class="font-weight-bold text-center">Nama Beras</th>
                <th width="15%" class="font-weight-bold text-center">Persediaan Awal</th>
                <th width="15%" class="font-weight-bold text-center">Sisa Persediaan</th>
                <th width="15%" class="font-weight-bold text-center">Terjual</th>
            </tr>
        </thead>
        <tbody>
            <?php $totals = 0 ?>
            @foreach ($persediaan as $key => $pecah )
            <tr>
                <td style="text-align: center">{{$key +1}}</td>
                <td>{{$pecah->judul_produk}}</td>
                <td style="text-align: center">{{$pecah->persediaan_awal}}</td>
                <td style="text-align: center">{{$pecah->persediaan_sisa}}</td>
                <td style="text-align: center">{{$pecah->terjual}}</td>
            </tr>
            <?php $totals += $pecah->terjual ?>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="font-style: bold;text-align: left">Total Terjual</td>
                <td style="font-style: bold;text-align: center">{{$totals}}</td>
            </tr>
        </tfoot>
    </table>
    <br>
    <div style="padding-left: 500px;font-size: 12px;">
        <p style="text-align: center;font-size: 12px;">Padang, {{$sekarang}}</p>
        <p style="text-align: center;font-size: 12px;"> KEPALA</p>
        <br><br><br>
        <p style="text-align: center;font-weight: bold;"><strong>H. Danir</strong> <br> <strong>Toko Beras H.
                Danir</strong></p>
    </div>


</body>

</html>