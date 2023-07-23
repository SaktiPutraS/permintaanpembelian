<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemasokController extends Controller
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
        $datas = DB::table('pemasok')->get();

        $latest_data = DB::table('pemasok')
            ->orderBy('kode_pemasok', 'desc')
            ->first();
        if ($latest_data) {
            $last_number = (int) substr($latest_data->kode_pemasok, 2);
        } else {
            $last_number = 0;
        }
        $next_number = $last_number + 1;
        $kode_pemasok_terakhir = 'S-' . str_pad($next_number, 4, '0', STR_PAD_LEFT);

        return view('pemasok.index', compact('datas','kode_pemasok_terakhir'));
    }

    public function save(Request $request)
    {
        DB::table('pemasok')->insert([
            'kode_pemasok' => $request->kode_pemasok,
            'nama_pemasok' => $request->nama_pemasok,
        ]);

        return back();
    }

    public function update(Request $request)
    {
        DB::table('pemasok')
            ->where('kode_pemasok', $request->kode_pemasok)
            ->update([
                'nama_pemasok' => $request->nama_pemasok,
            ]);

        return back();
    }

    public function delete($id)
    {
        DB::table('pemasok')
            ->where('kode_pemasok', $id)
            ->delete();

        return back();
    }
}
