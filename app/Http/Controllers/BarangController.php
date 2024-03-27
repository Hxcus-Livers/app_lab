<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Barang;
use App\Models\JenisBarang;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        // $barang = Barang::with('jenis_barang')->get();
        $jenis_barang = JenisBarang::with('barang')->get();
        // echo'<pre>';
        // print_r($barang);die;
        // echo'</pre>';
        // dd($barang);
        // die;
        return response(view('item.index', ['jenis_barang' => $jenis_barang]));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisBarang = JenisBarang::all();
        return view('item.create', compact('jenisBarang'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jenis_barang_id' => 'required|exists:jenis_barang,id',
            'total' => 'required|int|max:5',
        ]);

        // Buat dan simpan barang baru  
        Barang::create($validatedData);

        // Redirect ke halaman lain
        return redirect()->route('item.index');
    }

    public function detail($id)
    {
        // $barang = Barang::select('nama_barang')->jenisBarang()->find($id_barang);
        // dd($barang);
        // $jenisBarang = JenisBarang::find(1);
        // if ($jenisBarang) {
        // echo $jenisBarang->nama_jenis_barang;
        // } else {
        // echo "Jenis Barang tidak ditemukan";
        // }

        // $barang = Barang::find($id_barang)->jenisBarang;

        // foreach ($barang as $barang) {
        //     $barang = Barang::find($id_barang)->jenisBarang()
        //         ->where('title', 'foo')
        //         ->first();
        // }

        $perPage = 5;
        $jenisBarang = JenisBarang::find($id);
        $barang = $jenisBarang->Barang()->paginate($perPage);
        // dd($barang);


        return view('item.detail', compact('barang'));
    }

    public function show(Barang $barang)
    {
        // $barang is already populated with the model instance based on route parameter

        return view('item.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $barang = Barang::findOrFail($id);

        if ($barang->delete()) {
            return redirect(route('item.index'))->with('success', 'Data has been Successfully Deleted!');
        }

        return redirect(route('item.destroy'))->with('error', 'Sorry, unable to delete this!');
    }
}
