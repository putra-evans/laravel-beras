<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\Kategori;
use Illuminate\Http\Request;

class UtamaController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('front.produk', [
            'kategori' => $kategori,
        ]);
    }
    public function about()
    {
        return view('front.tentang');
    }
    public function kontak()
    {
        return view('front.kontak');
    }
}
