<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $datas = DB::table('users')->get();

        return view('user.index', compact('datas'));
    }

    public function save(Request $request)
    {
        DB::table('users')->insert([
            'name' => $request->name,
            'level' => $request->level,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return back();
    }

    public function update(Request $request)
    {
        if ($request->password) {
            DB::table('users')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'level' => $request->level,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
        } else {
            DB::table('users')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'level' => $request->level,
                'email' => $request->email,
            ]);
        }

        return back();
    }

    public function delete($id)
    {
        DB::table('users')
            ->where('id', $id)
            ->delete();

        return back();
    }
}
