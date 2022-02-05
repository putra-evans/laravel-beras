<?php

use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\admin\LaporanController;
use App\Http\Controllers\admin\PemesananController;
use App\Http\Controllers\admin\ProdukController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\user\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\user\UtamaController;
use App\Models\admin\Kategori;
use App\Models\admin\Produk;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// $jenisPeralatanS = \App\Models\Sipabo\RefJenisPeralatan::all();
Route::get('/', function () {
    $kategori = \App\Models\admin\Kategori::all();
    return view('front.produk', [
        'kategori' => $kategori,
    ]);
});

Route::get('utama', [UtamaController::class, 'index'])->name('utama');
Route::get('about-us', [UtamaController::class, 'about'])->name('about-us');
Route::get('kontak-kami', [UtamaController::class, 'kontak'])->name('kontak-kami');




Route::post('/product/all', function (Request $request) {
    $id_kategori   = $request['id_kategori'];
    $query = \App\Models\admin\Produk::query();
    $query = $query->with('kategori');
    // $query->whereRaw('stok - usulan > 0');

    if (!empty($id_kategori)) {
        $query = $query->whereIn('id_kategori', $id_kategori);
    }

    $products = $query->paginate(20);
    return $products;

    return \DataTables::of($products)
        ->make(true);
})->name('product.all');


Auth::routes();


// Route::group(['middleware' => ['auth']], function () {
//     Route::resource('kategori', KategoriController::class);
//     Route::resource('produk', ProdukController::class);
// });


Route::group(['middleware' => ['role:admin']], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // KATEGORI ROUTE
    Route::get('halaman-user', [UserController::class, 'index'])->name('halaman-user');
    Route::post('update-user', [UserController::class, 'update'])->name('update-user');
    Route::post('hapus-user',   [UserController::class, 'destroy'])->name('hapus-user');


    // KATEGORI ROUTE
    Route::get('halaman-kategori', [KategoriController::class, 'index'])->name('halaman-kategori');
    Route::post('save-kategori',   [KategoriController::class, 'store'])->name('simpan-kategori');
    Route::post('hapus-kategori',   [KategoriController::class, 'destroy'])->name('hapus-kategori');
    Route::post('update-kategori',   [KategoriController::class, 'update'])->name('update-kategori');

    // PRODUK ROUTE
    Route::get('halaman-produk', [ProdukController::class, 'index'])->name('halaman-produk');
    Route::post('save-produk',   [ProdukController::class, 'store'])->name('simpan-produk');
    Route::post('hapus-produk',   [ProdukController::class, 'destroy'])->name('hapus-produk');
    Route::post('update-produk',   [ProdukController::class, 'update'])->name('update-produk');
    Route::get('get-jenis-beras',   [ProdukController::class, 'get_kategori'])->name('get-jenis-beras');
    // PRODUK PMESANAN
    Route::get('halaman-pemesanan', [PemesananController::class, 'index'])->name('halaman-pemesanan');
    Route::get('detail-pemesanan', [PemesananController::class, 'get_detail'])->name('detail-pemesanan');
    Route::get('get-file', [PemesananController::class, 'get_file'])->name('get-file');
    Route::post('update-status', [PemesananController::class, 'update_status'])->name('update-status');

    Route::get('get-laporan', [LaporanController::class, 'index'])->name('get-laporan');

    Route::get('lap-penjualan', [LaporanController::class, 'laporan_penjualan'])->name('lap-penjualan');
    Route::get('lap-persediaan', [LaporanController::class, 'laporan_persediaan'])->name('lap-persediaan');
});


Route::group(['middleware' => ['role:user']], function () {

    Route::get('/beranda', [FrontController::class, 'index'])->name('beranda');
    Route::post('add-cart', [FrontController::class, 'store'])->name('add-cart');
    Route::post('view-cart', [FrontController::class, 'view_cart'])->name('view-cart');
    Route::post('count-cart', [FrontController::class, 'count_cart'])->name('count-cart');
    Route::get('view-checkout', [FrontController::class, 'view_checkout'])->name('view-checkout');
    Route::get('get-cities', [FrontController::class, 'getCities'])->name('get-cities');
    Route::post('get-ongkir', [FrontController::class, 'check_ongkir'])->name('get-ongkir');
    Route::post('save-pemesanan',   [FrontController::class, 'store_pemesanan'])->name('save-pemesanan');
    Route::get('my-order', [FrontController::class, 'view_order'])->name('my-order');
    Route::post('view-myorder', [FrontController::class, 'list_myorder'])->name('view-myorder');

    Route::get('view-detail', [FrontController::class, 'get_detail'])->name('view-detail');
    Route::post('upload-bayar', [FrontController::class, 'upload_pembayaran'])->name('upload-bayar');


    Route::get('tambah-produk', [FrontController::class, 'tambah_produk'])->name('tambah-produk');
    Route::get('kurang-produk', [FrontController::class, 'kurang_produk'])->name('kurang-produk');

    Route::post('konfirmasi-pesanan', [FrontController::class, 'konfirmasi_pesanan'])->name('konfirmasi-pesanan');




    // Route::post('update-produk',   [ProdukController::class, 'update'])->name('update-produk');
});
