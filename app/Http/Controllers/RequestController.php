<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\RequestUser;

class RequestController extends Controller
{
    public function index(): Response
    {
        // $barang = Barang::with('jenis_barang')->get();
        $request_user = RequestUser::all();
        // echo'<pre>';
        // print_r($barang);die;
        // echo'</pre>';
        // dd($barang);
        // die;
        return response(view('user.index', ['request_user' => $request_user]));
    }

    public function create()
    {
        $request_user = RequestUser::all();
        return view('user.pinjam', compact('request_user'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'barang_dipinjam' => 'nullable|string',
            'total_barang'
        ]);

        // Buat dan simpan barang baru  
        RequestUser::create($validatedData);

        // Redirect ke halaman lain
        return redirect()->route('user.index');
    }
}
