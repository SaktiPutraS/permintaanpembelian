<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JabatanController extends Controller
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
        $datas = DB::table('jabatan')->get();

        return view('jabatan.index', compact('datas'));
    }

    public function save(Request $request)
    {
        DB::table('jabatan')->insert([
            'kd_jabatan' => $request->kd_jabatan,
            'nama_jabatan' => $request->nama_jabatan,
        ]);

        return back();
    }

    public function update(Request $request)
    {
        DB::table('jabatan')
            ->where('kd_jabatan', $request->kd_jabatan)
            ->update([
                'nama_jabatan' => $request->nama_jabatan,
            ]);

        return back();
    }

    public function delete($id)
    {
        DB::table('jabatan')
            ->where('kd_jabatan', $id)
            ->delete();

        return back();
    }
}
