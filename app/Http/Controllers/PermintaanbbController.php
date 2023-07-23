<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermintaanbbController extends Controller
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
        $datas = DB::table('permintaan_bahanbaku')
            ->select('id_permintaan', 'tgl_permintaan', 'nama_peminta', 'nama_divisi')
            ->groupby('id_permintaan', 'tgl_permintaan', 'nama_peminta', 'nama_divisi')
            ->get();

        return view('permintaanbb.index', compact('datas'));
    }

    public function create()
    {
        //Tanggal Sekarang
        $datenow = Carbon::now()->format('Y-m-d');
        // Ambil Nomor AKhir
        $latest_data = DB::table('permintaan_bahanbaku')
            ->orderBy('id_permintaan', 'desc')
            ->first();
        if ($latest_data) {
            $last_number = (int) substr($latest_data->id_permintaan, 2);
        } else {
            $last_number = 0;
        }
        $next_number = $last_number + 1;
        $id_permintaan_terakhir = 'PB' . str_pad($next_number, 4, '0', STR_PAD_LEFT);

        $user = DB::table('karyawan')->get();
        $divisi = DB::table('jabatan')->get();
        $bahanbaku = DB::table('bahanbaku')->get();

        return view('permintaanbb.create', compact('datenow', 'id_permintaan_terakhir', 'user', 'divisi', 'bahanbaku'));
    }

    public function save(Request $request)
    {
        DB::table('permintaan_bahanbaku')->insert([
            'id_permintaan' => $request->id_permintaan,
            'tgl_permintaan' => $request->tgl_permintaan,
            'nama_peminta' => $request->nama_peminta,
            'nama_divisi' => $request->nama_divisi,
            'kd_bahanbaku' => $request->kd_bahanbaku,
            'jumlah_permintaan' => $request->jumlah_permintaan == '' ? 1 : $request->jumlah_permintaan,
            'tgl_butuh' => $request->tgl_butuh,
            'status' => 'Proses',
        ]);

        return redirect('/permintaanbb/edit/' . $request->id_permintaan);
    }

    public function edit($id)
    {
        $datenow = Carbon::now()->format('Y-m-d');
        $header = DB::table('permintaan_bahanbaku')
            ->where('id_permintaan', $id)
            ->first();

        $details = DB::table('permintaan_bahanbaku')
            ->leftjoin('bahanbaku', 'bahanbaku.kd_bahanbaku', 'permintaan_bahanbaku.kd_bahanbaku')
            ->where('id_permintaan', $id)
            ->get();

        $bahanbaku = DB::table('bahanbaku')->get();

        return view('permintaanbb.edit', compact('datenow', 'header', 'details', 'bahanbaku'));
    }

    public function delete($id)
    {
        DB::table('permintaan_bahanbaku')
            ->where('id_permintaan', $id)
            ->delete();

        return back();
    }

    public function deletebarang($id, $kd_bahanbaku)
    {
        $datas = DB::table('permintaan_bahanbaku')
            ->where('id_permintaan', $id)
            ->get();
        $count = $datas->count();

        DB::table('permintaan_bahanbaku')
            ->where('id_permintaan', $id)
            ->where('kd_bahanbaku', $kd_bahanbaku)
            ->delete();

        if ($count == 1) {
            return redirect('/permintaanbb');
        } else {
            return back();
        }
    }
}
