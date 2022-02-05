<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Kategori;
use App\Models\admin\Produk;
use App\Models\City;
use Illuminate\Http\Request;
// use DataTables;
use Yajra\DataTables\Facades\DataTables;


class ProdukController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $produk = Produk::with('kategori')
                ->orderBy('id_produk', 'DESC')
                ->get();

            return Datatables::of($produk)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $btn = '<button id="detailBtn" type="button" data-toggle="modal" data-target="#detail_produk" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></button>
                    <button id="editBtn" type="button" data-toggle="modal" data-target="#add_produk" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></button>
                    <button id="deleteBtn" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $kategori = \App\Models\admin\Kategori::all();
        $city = City::where('province_id', 32)->get();

        return view('admin.produk.index', [
            'kategori' => $kategori,
            'city_id' => $city,
        ]);
    }
    public function store(Request $request)
    {
        $success = false;
        $message = '';

        try {
            $data = $request->input();
            Produk::create($data);
            $success = true;
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return response()
            ->json(['success' => $success, 'message' => $message]);
    }

    public function update(Request $request)
    {

        $success = false;
        $message = '';

        try {
            $data = $request->input();
            Produk::find($data['id_produk'])->update($data);
            $success = true;
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return response()
            ->json(['success' => $success, 'message' => $message]);
    }


    public function destroy(Request $request)
    {
        $success = false;
        $message = '';
        try {
            Produk::where('id_produk', '=', $request->id)->delete();
            $success = true;
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return response()
            ->json(['success' => $success, 'message' => $message]);
    }

    public function get_kategori(Request $request)
    {
        $id = $request->get('jenis');
        $city = Kategori::where('id_city', $id)->get();

        return response()->json(['data' => $city, 'status' => '200']);
    }
}
