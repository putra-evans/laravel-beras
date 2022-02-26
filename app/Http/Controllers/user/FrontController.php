<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\Kategori;
use App\Models\Cart;
use App\Models\City;
use App\Models\Courier;
use App\Models\Detailpemesanan;
use App\Models\Fileupload;
use App\Models\Pemesanan;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kategori = Kategori::all();
        return view('front.produk', [
            'kategori' => $kategori,
        ]);
    }

    public function store(Request $request)
    {
        $success = false;
        $message = '';

        try {
            $id_user = $request->input('id_user');
            $id_produk = $request->input('id_produk');

            $qty = $request->input('qty');
            $harga = $request->input('harga');


            $cek = DB::table('keranjang')
                ->select(DB::raw('count(*) as total'))
                ->where('id_user', $id_user)
                ->where('id_produk', $id_produk)
                ->get()->toArray();

            if ($cek[0]->total == '0') {
                $total_harga = $qty * $harga;

                Cart::create([
                    'id_produk' => $id_produk,
                    'id_user' => $id_user,
                    'qty' => $qty,
                    'total_harga' => $total_harga,
                ]);
                $success = true;
            } else {
                $ambilqty = DB::table('keranjang')
                    ->select('qty')
                    ->where('id_user', $id_user)
                    ->where('id_produk', $id_produk)
                    ->get()->toArray();
                $Tqty = $qty + $ambilqty[0]->qty;
                $Tharga = $Tqty * $harga;
                $affected = DB::table('keranjang')
                    ->where('id_user', $id_user)
                    ->where('id_produk', $id_produk)
                    ->update([
                        'qty' => $Tqty,
                        'total_harga' => $Tharga,
                    ]);
                $success = true;
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return response()
            ->json(['success' => $success, 'message' => $message]);
    }
    public function view_cart(Request $request)
    {

        $id_user = $request->input('id_user');

        $keranjang = DB::table('keranjang')
            ->join('produk', 'keranjang.id_produk', '=', 'produk.id_produk')
            ->select('keranjang.*', 'produk.*')
            ->where('id_user', $id_user)
            ->get();
        return $keranjang;
    }

    public function count_cart(Request $request)
    {

        $id_user = $request->input('id_user');

        $total = DB::table('keranjang')
            ->select(DB::raw('count(*) as total'))
            ->where('id_user', $id_user)
            ->get()->toArray();
        return $total;
    }

    public function view_checkout()
    {
        $couriers = Courier::pluck('title', 'code');
        $provinces = Province::pluck('title', 'province_id');
        return view('front.checkout', compact('couriers', 'provinces'));
    }

    public function getCities(Request $request)
    {
        $id = $request->get('id');
        $city = City::where('province_id', $id)->pluck('title', 'city_id');
        return json_encode($city);
    }

    public function check_ongkir(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => 318, // ID kota/kabupaten asal
            'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
            'weight'        => $request->weight, // berat barang dalam gram
            'courier'       => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();
        return response()->json($cost);
    }


    public function store_pemesanan(Request $request)
    {
        $success = false;
        $message = '';

        try {
            $id_user = $request->input('user_id');
            $NamaCust = $request->input('NamaCust');
            $HpCust = $request->input('HpCust');
            $AlamatCust = $request->input('AlamatCust');
            $province_destination = $request->input('province_destination');
            $city_destination = $request->input('city_destination');
            $weight = $request->input('weight');
            $jasaKirim = $request->input('jasaKirim');
            $HiddenTotal = $request->input('HiddenTotal');
            $HargaOngkir = $request->input('HargaOngkir');
            $Estimasi = $request->input('Estimasi');
            $TBayar = $request->input('TBayar');

            $pesan = Pemesanan::create([
                'id_user' => $id_user,
                'nama_penerima' => $NamaCust,
                'no_hp_penerima' => $HpCust,
                'alamat_penerima' => $AlamatCust,
                'provinsi_tujuan' => $province_destination,
                'kota_tujuan' => $city_destination,
                'berat_barang' => $weight,
                'harga_barang' => $HiddenTotal,
                'jasa_kirim' => $jasaKirim,
                'ongkir' => $HargaOngkir,
                'estimasi' => $Estimasi,
                'total_bayar' => $TBayar,
                'status_pesanan' => 'Menunggu Pembayaran',
            ]);
            $id = DB::getPdo()->lastInsertId();
            $ambilproduk = DB::table('keranjang')
                ->select('*')
                ->where('id_user', $id_user)
                ->get();

            foreach ($ambilproduk as $key) {
                Detailpemesanan::create([
                    'id_pemesanan' => $id,
                    'id_produk' => $key->id_produk,
                    'qty' => $key->qty,
                    'total_harga' => $key->total_harga,
                ]);
            }
            Cart::where('id_user', '=', $id_user)->delete();

            $success = true;
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return response()
            ->json(['success' => $success, 'message' => $message]);
    }
    public function view_order()
    {
        return view('front.pesanan');
    }

    public function list_myorder(Request $request)
    {

        $id_user = $request->input('id_user');

        $pesanan = DB::table('ta_pemesanan')
            // ->join('ta_detail_pemesanan', 'ta_pemesanan.id_pemesanan', '=', 'ta_detail_pemesanan.id_pemesanan')
            // ->select('ta_pemesanan.*', 'ta_detail_pemesanan.*')
            ->where('ta_pemesanan.id_user', $id_user)
            ->get();
        return $pesanan;
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
    public function upload_pembayaran(Request $request)
    {

        $success = false;
        $message = '';
        try {
            $id_pemesanan = $request->input('id_pemesanan');

            $file_bukti = $request->file('file_bukti');
            $nama_bukti = $file_bukti->hashName();
            $file_bukti->move(public_path('img'), $nama_bukti);

            Fileupload::create([
                'id_pemesanan' => $id_pemesanan,
                'file_upload' => $nama_bukti,
            ]);

            $affected = DB::table('ta_pemesanan')
                ->where('id_pemesanan', $id_pemesanan)
                ->update([
                    'status_pesanan' => 'Cek Pembayaran',
                ]);
            $success = true;
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return response()
            ->json(['success' => $success, 'message' => $message]);
    }



    public function tambah_produk(Request $request)
    {

        $id_keranjang = $request->get('id_keranjang');
        $id_produk = $request->get('id_produk');
        $id_user = $request->get('id_user');
        $qty = $request->get('qty');
        $harga = $request->get('harga');
        $total_harga = $request->get('total_harga');
        $totqty = $qty + 1;
        $totharga = $totqty * $harga;
        $affected = DB::table('keranjang')
            ->where('id_keranjang', $id_keranjang)
            ->where('id_produk', $id_produk)
            ->where('id_user', $id_user)
            ->update([
                'qty' => $totqty,
                'total_harga' => $totharga,
            ]);
        return $affected;
    }
    public function kurang_produk(Request $request)
    {
        $id_keranjang = $request->get('id_keranjang');
        $id_produk = $request->get('id_produk');
        $id_user = $request->get('id_user');
        $qty = $request->get('qty');
        $harga = $request->get('harga');
        $total_harga = $request->get('total_harga');
        $totqty = $qty - 1;
        $totharga = $totqty * $harga;
        $affected = DB::table('keranjang')
            ->where('id_keranjang', $id_keranjang)
            ->where('id_produk', $id_produk)
            ->where('id_user', $id_user)
            ->update([
                'qty' => $totqty,
                'total_harga' => $totharga,
            ]);
        return $affected;
    }
    public function delete_keranjang(Request $request)
    {
        $id_keranjang = $request->get('id_keranjang');
        $id_produk = $request->get('id_produk');
        $id_user = $request->get('id_user');
        $affected = DB::table('keranjang')
            ->where('id_keranjang', $id_keranjang)
            ->where('id_produk', $id_produk)
            ->where('id_user', $id_user)
            ->delete();
        return $affected;
    }

    public function konfirmasi_pesanan(Request $request)
    {
        $id_pemesanan_konf = $request->post('id_pemesanan_konf');
        $konfirmasi = DB::table('ta_pemesanan')
            ->where('id_pemesanan', $id_pemesanan_konf)
            ->update([
                'status_pesanan' => 'Selesai',
            ]);
        return $konfirmasi;
    }
}
