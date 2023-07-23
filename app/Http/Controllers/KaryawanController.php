<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
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
        $karyawans = DB::table('karyawan')->get();
        $jabatans = DB::table('jabatan')->get();

        return view('karyawan.index', compact('karyawans','jabatans'));
    }

    public function save(Request $request)
    {
        DB::table('karyawan')->insert([
            'id_karyawan' => $request->id_karyawan,
            'nama_karyawan' => $request->nama_karyawan,
            'kd_jabatan' => $request->kd_jabatan,
            'jk' => $request->jk,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'telp' => $request->telp,
        ]);

        return back();
    }

    public function update(Request $request)
    {
        DB::table('karyawan')
            ->where('id_karyawan', $request->id_karyawan)
            ->update([
                'id_karyawan' => $request->id_karyawan,
                'nama_karyawan' => $request->nama_karyawan,
                'kd_jabatan' => $request->kd_jabatan,
                'jk' => $request->jk,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
                'agama' => $request->agama,
                'telp' => $request->telp,
            ]);

        return back();
    }

    public function delete($id)
    {
        DB::table('karyawan')
            ->where('id_karyawan', $id)
            ->delete();

        return back();
    }
}
