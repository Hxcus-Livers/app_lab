<?php

namespace App\Http\Controllers;

use App\Models\Requests;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RequestController extends Controller
{

  public function create()
  {
    $requests = Requests::all();
    return view('user.pinjam', compact('requests'));
  }
  /**
   * Menyimpan permintaan baru.
   *
   * @param  HttpRequest  $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(Request $request)
  {
    // Validate request data
    // $this->validate($request, [
    $validatedData = $request->validate([
      'user_id' => 'required|integer',
      'item_name' => 'required|string|max:255',
      'quantity' => 'required|integer|min:1',
    ]);

    Requests::create($validatedData);

        // Redirect ke halaman lain
        return redirect()->route('low-user.index');

    // Create a new request object
    $request = new Requests;
    $request->user_id = $request->input('user_id');
    $request->item_name = $request->input('item_name');
    $request->quantity = $request->input('quantity');

    // Save the request to the database
    $request->save();

    // Optional: Flash a success message to the session
    session()->flash('success', 'Request submitted successfully!');

    // Redirect to a relevant page (e.g., show request details)
    return redirect()->route('requests.show', $request->id); // Replace 'requests.show' with your actual route name
  }

}
