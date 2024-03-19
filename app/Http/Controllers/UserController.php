<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Barang;
use App\Models\JenisBarang;

class UserController extends Controller
{
    public function index(): Response
    {
        // $barang = Barang::with('jenis_barang')->get();
        $jenis_barang = JenisBarang::all();
        // echo'<pre>';
        // print_r($barang);die;
        // echo'</pre>';
        // dd($barang);
        // die;
        return response(view('user.index', ['jenis_barang' => $jenis_barang]));
    }

    public function detail($id_barang)
    {
        $jenisBarang = JenisBarang::find($id_barang);
        $barang = $jenisBarang->Barang;
        // dd($barang);


        return view('user.detail', compact('barang'));
    }
}
