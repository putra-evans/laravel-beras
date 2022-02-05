<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }
    public function laporan_penjualan(Request $request)
    {
        $bulan = $request->bulantahun;
        // $registeredAt = $bulan->format('MMMM Y');
        $registeredAt = Carbon::parse($bulan)->format('M Y');
        $today = Carbon::today()->format('d M Y');
        $date_explode = explode('-', $bulan);

        $thn = $date_explode[0];
        $bln = $date_explode[1];

        $data = DB::table('ta_pemesanan')
            ->whereMonth('created_at', $bln)
            ->whereYear('created_at', $thn)
            ->where('status_pesanan', 'Selesai')
            ->get()->toArray();

        $pdf = PDF::loadView('admin/laporan/print_produk', [
            'penjualan' => $data,
            'bulan' => $registeredAt,
            'sekarang' => $today,
        ]);

        return $pdf->download('laporan-penjualan.pdf');
    }
    public function laporan_persediaan(Request $request)
    {
        $bulan = $request->bulantahun;
        $registeredAt = Carbon::parse($bulan)->format('M Y');
        $today = Carbon::today()->format('d M Y');
        $date_explode = explode('-', $bulan);

        $thn = $date_explode[0];
        $bln = $date_explode[1];

        $data = DB::table('ta_pemesanan')
            ->select(
                'ta_pemesanan.id_pemesanan',
                'ta_pemesanan.status_pesanan',
                'produk.judul_produk',
                'produk.persediaan_awal',
                'produk.persediaan_sisa',
                DB::raw('SUM(ta_detail_pemesanan.qty) as terjual')
            )
            ->leftJoin('ta_detail_pemesanan', 'ta_detail_pemesanan.id_pemesanan', '=', 'ta_pemesanan.id_pemesanan')
            ->rightJoin('produk', 'produk.id_produk', '=', 'ta_detail_pemesanan.id_produk')
            ->whereMonth('ta_pemesanan.created_at', $bln)
            ->whereYear('ta_pemesanan.created_at', $thn)
            ->where('ta_pemesanan.status_pesanan', 'Selesai')
            ->groupBy('ta_detail_pemesanan.id_produk', 'ta_pemesanan.id_pemesanan')
            ->get()->toArray();

        $pdf = PDF::loadView('admin/laporan/print_persediaan', [
            'persediaan' => $data,
            'bulan' => $registeredAt,
            'sekarang' => $today,
        ]);

        return $pdf->download('laporan-persediaan.pdf');
    }
}
