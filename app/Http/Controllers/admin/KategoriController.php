<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Kategori;
use App\Models\City;
use DataTables;



class KategoriController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $kategori = Kategori::join('cities', 'cities.city_id', '=', 'kategori_beras.id_city')
                ->orderBy('id_kategori', 'DESC')
                ->get();
            return Datatables::of($kategori)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $btn = '<button id="editBtn" type="button" data-toggle="modal" data-target="#modal-lg" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></button>
                    <button id="deleteBtn" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $city = City::where('province_id', 32)->pluck('title', 'city_id');
        return view('admin.kategori.index', [
            'kabkota' => $city
        ]);
    }
    public function store(Request $request)
    {
        $success = false;
        $message = '';

        try {
            $data = $request->input();
            Kategori::create($data);

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
            Kategori::find($data['id_kategori'])->update($data);
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
            Kategori::where('id_kategori', '=', $request->id)->delete();
            $success = true;
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return response()
            ->json(['success' => $success, 'message' => $message]);
    }
}
