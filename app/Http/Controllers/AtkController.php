<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AtkController extends Controller
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
        $datas = DB::table('atk')->get();

        //Ambil Nomor Terakhir
        $latest_data = DB::table('atk')
            ->orderBy('kd_atk', 'desc')
            ->first();
        if ($latest_data) {
            $last_number = (int) substr($latest_data->kd_atk, 3);
        } else {
            $last_number = 0;
        }
        $next_number = $last_number + 1;
        $kode_atk_terakhir = 'ATK' . str_pad($next_number, 4, '0', STR_PAD_LEFT);

        return view('atk.index', compact('datas','kode_atk_terakhir'));
    }

    public function save(Request $request)
    {
        DB::table('atk')->insert([
            'kd_atk' => $request->kd_atk,
            'nama_atk' => $request->nama_atk,
            'jenis_atk' => $request->jenis_atk,
            'stok' => $request->stok == '' ? 0 : $request->stok,
        ]);

        return back();
    }

    public function update(Request $request)
    {
        DB::table('atk')
            ->where('kd_atk', $request->kd_atk)
            ->update([
                'nama_atk' => $request->nama_atk,
                'jenis_atk' => $request->jenis_atk,
                'stok' => $request->stok == '' ? 0 : $request->stok,
            ]);

        return back();
    }

    public function delete($id)
    {
        DB::table('atk')
            ->where('kd_atk', $id)
            ->delete();

        return back();
    }
}
