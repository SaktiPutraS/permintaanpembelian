<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BahanbakuController extends Controller
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
        $datas = DB::table('bahanbaku')->get();

        //Ambil Nomor Terakhir
        $latest_data = DB::table('bahanbaku')
            ->orderBy('kd_bahanbaku', 'desc')
            ->first();
        if ($latest_data) {
            $last_number = (int) substr($latest_data->kd_bahanbaku, 2);
        } else {
            $last_number = 0;
        }
        $next_number = $last_number + 1;
        $kode_bahanbaku_terakhir = 'BB' . str_pad($next_number, 4, '0', STR_PAD_LEFT);

        return view('bahanbaku.index', compact('datas', 'kode_bahanbaku_terakhir'));
    }

    public function save(Request $request)
    {
        DB::table('bahanbaku')->insert([
            'kd_bahanbaku' => $request->kd_bahanbaku,
            'nama_bahanbaku' => $request->nama_bahanbaku,
            'jenis_bahanbaku' => $request->jenis_bahanbaku,
            'stok' => $request->stok == '' ? 0 : $request->stok,
        ]);

        return back();
    }

    public function update(Request $request)
    {
        DB::table('bahanbaku')
            ->where('kd_bahanbaku', $request->kd_bahanbaku)
            ->update([
                'nama_bahanbaku' => $request->nama_bahanbaku,
                'jenis_bahanbaku' => $request->jenis_bahanbaku,
                'stok' => $request->stok == '' ? 0 : $request->stok,
            ]);

        return back();
    }

    public function delete($id)
    {
        DB::table('bahanbaku')
            ->where('kd_bahanbaku', $id)
            ->delete();

        return back();
    }
}
