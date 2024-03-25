<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;

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

  // private function diffForHumans($date) {
  //     if (!$date) {
  //       return 'N/A (No date available)';
  //     }

  //     $now = new DateTime();
  //     $interval = $now->diff($date);
  //     $elapsed = $interval->days * 24 * 60 + $interval->h * 60 + $interval->i;

  //     if ($elapsed < 1) {
  //       return 'Baru saja';
  //     } elseif ($elapsed < 60) {
  //       return $elapsed . ' menit yang lalu';
  //     } elseif ($elapsed < 120) {
  //       return 'Sekitar 1 jam yang lalu';
  //     } elseif ($elapsed < (24 * 60)) {
  //       return round($elapsed / 60) . ' jam yang lalu';
  //     } elseif ($elapsed < (2 * 24 * 60)) {
  //       return 'Kemarin';
  //     } else {
  //       return round($elapsed / (24 * 60)) . ' hari yang lalu';
  //     }
  //   }      

  public function index()
  {
    $requestPeminjamanBelumDibaca = Request::where('dibaca', false)->get();

    foreach ($requestPeminjamanBelumDibaca as $request) {
      $request->timeSinceCreation = Carbon::parse($request->created_at)->diffForHumans();
    }

    return view('layouts.master', compact('requestPeminjamanBelumDibaca'));
  }

  public function notice()
  {
    $request_user = RequestUser::all();

    return view('admin.view-request', compact('request_user'));
  }

  public function create()
  {
    $request_user = RequestUser::all();
    return view('request.create', compact('request_user'));
  }

  public function store(Request $request)
  {
    // Validasi input
    $validatedData = $request->validate([
      'nama' => 'required|string|max:255',
      'kelas' => 'required|string|max:10',
      'alamat' => 'required|string',
      'barang_dipinjam' => 'required|string',
      'total_barang' => 'required|integer',
    ]);


    // Buat dan simpan barang baru  
    RequestUser::create($validatedData);

    // Buat notifikasi untuk admin
    // $notifikasi = [
    //     'judul' => 'Permintaan Peminjaman Baru',
    //     'isi' => 'Permintaan peminjaman baru dari ' . $validatedData['nama'],
    // ];


    // Tampilkan pesan sukses
    return redirect()->route('user.pinjam')->with('success', 'Permintaan peminjaman berhasil dikirim!');
  }

  public function show(RequestUser $request_user)
  {
    if (!$request_user->dibaca) {
      $request_user->update(['dibaca' => true]);
    }

    // ... (kode lainnya untuk menampilkan detail request)

    return view('layouts.master', compact('request_user'));
  }

  public function updateStatus(Request $request, $id)
  {
    $request_user = Request::find($id);

  if ($request->has('delete')) {
    // Hapus data dari database
    $request_user->delete();

    return redirect()->route('request.index')->with('success', 'Data berhasil dihapus');
  }

    // $request_user = RequestUser::findOrFail($id);

    $request_user->status = $request->status;
    $request_user->save();

    return redirect()->route('request.notice');
  }
}
