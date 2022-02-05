<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PemesananController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $pemesanan = DB::table('ta_pemesanan')
                ->join('users', 'users.id', '=', 'ta_pemesanan.id_user')
                ->select('ta_pemesanan.*', 'users.name')
                ->get();

            return DataTables::of($pemesanan)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {

                    if ($item->status_pesanan == "Menunggu Pembayaran") {
                        $btn = '<button id="detailBtn" title="Detail Pesanan" type="button" data-toggle="modal" data-target="#detail_produk" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></button> <button id="BuktiPembayaran" title="Bukti Pembayaran" type="button" data-toggle="modal" data-target="#bukti_pembayaran" class="btn btn-success btn-sm"><i class="fas fa-dollar-sign"></i></button>
                    ';
                    } else {
                        $btn = '<button id="detailBtn" title="Detail Pesanan" type="button" data-toggle="modal" data-target="#detail_produk" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></button>
                        <button id="BuktiPembayaran" title="Bukti Pembayaran" type="button" data-toggle="modal" data-target="#bukti_pembayaran" class="btn btn-success btn-sm"><i class="fas fa-dollar-sign"></i></button>';
                    }
                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pemesanan.index');
    }

    public function get_detail(Request $request)
    {
        $id_pemesanan = $request->get('id_pemesanan');

        $pesanan = DB::table('ta_detail_pemesanan')
            ->join('ta_pemesanan', 'ta_pemesanan.id_pemesanan', '=', 'ta_detail_pemesanan.id_pemesanan')
            ->join('produk', 'produk.id_produk', '=', 'ta_detail_pemesanan.id_produk')
            ->join('provinces', 'provinces.province_id', '=', 'ta_pemesanan.provinsi_tujuan')
            ->join('cities', 'cities.city_id', '=', 'ta_pemesanan.kota_tujuan')
            ->select('ta_detail_pemesanan.*', 'ta_pemesanan.*', 'produk.*', 'provinces.title AS nama_prov', 'cities.title',)
            ->where('ta_detail_pemesanan.id_pemesanan', $id_pemesanan)
            ->get();
        return $pesanan;
    }
    public function get_file(Request $request)
    {
        $id_pemesanan = $request->get('id_pemesanan');

        $pesanan = DB::table('ta_file')
            ->where('ta_file.id_pemesanan', $id_pemesanan)
            ->get();
        return $pesanan;
    }
    public function update_status(Request $request)
    {

        $id_pemesanan = $request->input('id_pemesanan');
        $update_status = $request->input('update_status');
        $resi_pengiriman = $request->input('resi_pengiriman');


        if ($update_status != '' && $resi_pengiriman != '') {

            if ($update_status == 'Pembayaran Diterima') {
                // AMBIL STOK DIBELI
                $datadetail = DB::table('ta_detail_pemesanan')
                    ->where('ta_detail_pemesanan.id_pemesanan', $id_pemesanan)
                    ->get();

                foreach ($datadetail as $pecah) {
                    $id_produk = $pecah->id_produk;
                    $qty = $pecah->qty;
                    $dataproduk = DB::table('produk')
                        ->select('produk.id_produk', 'produk.persediaan_sisa')
                        ->where('produk.id_produk', $id_produk)
                        ->get();
                    $persediaan_sisa = $dataproduk[0]->persediaan_sisa;
                    $UpdateStok = DB::table('produk')
                        ->where('id_produk', $id_produk)
                        ->update([
                            'persediaan_sisa' => $persediaan_sisa - $qty,
                        ]);
                }
            }

            $Status = DB::table('ta_pemesanan')
                ->where('id_pemesanan', $id_pemesanan)
                ->update([
                    'status_pesanan' => $update_status,
                    'no_resi' => $resi_pengiriman,
                ]);
        } else if ($update_status != '') {

            if ($update_status == 'Pembayaran Diterima') {
                // AMBIL STOK DIBELI
                $datadetail = DB::table('ta_detail_pemesanan')
                    ->where('ta_detail_pemesanan.id_pemesanan', $id_pemesanan)
                    ->get();

                foreach ($datadetail as $pecah) {
                    $id_produk = $pecah->id_produk;
                    $qty = $pecah->qty;
                    $dataproduk = DB::table('produk')
                        ->select('produk.id_produk', 'produk.persediaan_sisa')
                        ->where('produk.id_produk', $id_produk)
                        ->get();
                    $persediaan_sisa = $dataproduk[0]->persediaan_sisa;
                    $UpdateStok = DB::table('produk')
                        ->where('id_produk', $id_produk)
                        ->update([
                            'persediaan_sisa' => $persediaan_sisa - $qty,
                        ]);
                }
            }

            $Status = DB::table('ta_pemesanan')
                ->where('id_pemesanan', $id_pemesanan)
                ->update([
                    'status_pesanan' => $update_status,
                ]);
        } else if ($resi_pengiriman != '') {
            $Status = DB::table('ta_pemesanan')
                ->where('id_pemesanan', $id_pemesanan)
                ->update([
                    'no_resi' => $resi_pengiriman,
                ]);
        } else {
            $Status = '';
        }

        return $Status;
    }
}
