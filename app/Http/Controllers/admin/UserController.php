<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $user = User::get();
            return Datatables::of($user)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $btn = '<button id="editBtn" type="button" data-toggle="modal" data-target="#modal-lg" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // <button id="deleteBtn" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
        return view('admin.user.index');
    }

    public function update(Request $request)
    {
        $pass = $request->input('password_baru');

        if ($pass != '') {
            $affected = DB::table('users')
                ->where('id', $request->input('id_user'))
                ->update([
                    'name' => $request->input('nama_user'),
                    'email' => $request->input('email_user'),
                    'password' => Hash::make($request->input('password_baru'))
                ]);
        } else {
            $affected = DB::table('users')
                ->where('id', $request->input('id_user'))
                ->update([
                    'name' => $request->input('nama_user'),
                    'email' => $request->input('email_user')
                ]);
        }

        return response()
            ->json(['success' => true, 'message' => 'berhasil']);
    }

    public function destroy(Request $request)
    {
        $success = false;
        $message = '';
        try {
            User::where('id', '=', $request->id)->delete();
            $success = true;
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return response()
            ->json(['success' => $success, 'message' => $message]);
    }
}
