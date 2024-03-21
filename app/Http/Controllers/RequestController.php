<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\RequestUser;

class RequestController extends Controller
{
    // public function index()
    // {
    //     $requestPeminjaman = RequestUser::where('status', '=', 'pending')
    //         ->where('dibaca', '=', false)
    //         ->orderBy('created_at', 'desc')
    //         ->take(5)
    //         ->get();

    //     return view('layouts.master', compact('requestPeminjaman'));
    // }



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
            'kelas' => 'required|string|max:10',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:peminjam',
            'barang_dipinjam' => 'required|string',
            'total_barang' => 'required|integer',
        ]);


        // Buat dan simpan barang baru  
        RequestUser::create($validatedData);

        // Buat notifikasi untuk admin
        $notifikasi = [
            'judul' => 'Permintaan Peminjaman Baru',
            'isi' => 'Permintaan peminjaman baru dari ' . $validatedData['nama'],
        ];


        // Tampilkan pesan sukses
        return redirect()->route('user.peminjam')->with('success', 'Permintaan peminjaman berhasil dikirim!');
    }

    public function show(RequestUser $request_user)
    {
        if (!$request_user->dibaca) {
            $request_user->update(['dibaca' => true]);
        }

        // ... (kode lainnya untuk menampilkan detail request)

        return view('layouts.master', compact('request_user'));
    }
}
