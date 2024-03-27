<?php

namespace App\Http\Controllers;

use App\Models\Requests;
use App\Models\User; // Jika relasi user didefinisikan di model RequestUser
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Kreait\Firebase\Messaging\FirebaseMessaging;
use Firebase\Messaging\Message;
use Illuminate\Support\Testing\Fakes\NotificationFake;
use Kutia\Larafirebase\Facades\Larafirebase;
use App\Notifications\SendPushNotification;


class RequestController extends Controller
{
  /**
   * Menyimpan permintaan baru.
   *
   * @param  HttpRequest  $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(Request $request)
  {
    // Validate request data
    $this->validate($request, [
      'user_id' => 'required|integer',
      'item_name' => 'required|string|max:255',
      'quantity' => 'required|integer|min:1',
    ]);

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


  // /**
  //  * Mengirim notifikasi FCM ke admin terkait permintaan baru.
  //  *
  //  * @param Request $requestUser
  //  * @return void
  //  */
  // private function sendNotificationToAdmin(Request $requestUser)
  // {
  //   $firebaseMessaging = app('firebase.messaging');

  //   $message = Message::create()
  //     ->setTopic('/topics/admin')
  //     ->setData([
  //       'type' => 'request',
  //       'request_id' => $requestUser->id,
  //       'user_name' => $requestUser->user->name ?? '', // Opsional: Menangani relasi user yang mungkin null
  //       'item_name' => $requestUser->item_name,
  //       'quantity' => $requestUser->quantity,
  //     ]);

  //   try {
  //     $firebaseMessaging->send($message);
  //   } catch (\Throwable $e) {
  //     // Menangani kemungkinan error pengiriman FCM (logging, retries, dll.)
  //     report($e);
  //   }
  // }

  // /**
  //  * Memvalidasi permintaan dan mengirim notifikasi FCM ke user.
  //  *
  //  * @param HttpRequest $request
  //  * @param RequestUser $requestUserModel
  //  * @return \Illuminate\Http\JsonResponse
  //  */
  // public function update(HttpRequest $request, Request $requestUserModel)
  // {
  //   $validator = Validator::make($request->all(), [
  //     'status' => 'required|in:success,rejected',
  //   ]);

  //   if ($validator->fails()) {
  //     return response()->json($validator->errors(), 422);
  //   }

  //   $validatedData = $validator->validated();
  //   $requestUserModel->update($validatedData);

  //   // Kirim notifikasi FCM ke user
  //   $this->sendNotificationToUser($requestUserModel);

  //   return response()->json($requestUserModel);
  // }

  // /**
  //  * Mengirim notifikasi FCM ke user tentang status permintaan.
  //  *
  //  * @param RequestUser $requestUser
  //  * @return void
  //  */
  // private function sendNotificationToUser(Request $requestUser)
  // {
  //   $firebaseMessaging = app('firebase.messaging');

  //   $message = Message::create()
  //     ->setTopic('/topics/user-' . $requestUser->user_id)
  //     ->setData([
  //       'type' => 'request_status',
  //       'request_id' => $requestUser->id,
  //       'status' => $requestUser->status,
  //     ]);

  //   try {
  //     $firebaseMessaging->send($message);
  //   } catch (\Throwable $e) {
  //     // Menangani kemungkinan error pengiriman FCM (logging, retries, dll.)
  //     report($e);
  //   }
  // }

  public function notification(Request $request)
  {
    $request->validate([
      'title' => 'required',
      'message' => 'required'
    ]);

    try {
      $fcmTokens = User::WhereNotNull('fcm_token')->pluck('fcm_token')->toArray();

      // Notification::send(null,new SendPushNotification($request->title,$request->message,$fcmTokens));

      /* or */

      //auth()->user()->notify(new SendPushNotification($title,$message,$fcmTokens));

      /* or */

      Larafirebase::withTitle($request->title)
        ->withBody($request->message)
        ->sendMessage($fcmTokens);

      return redirect()->back()->with('success', 'Notification Sent Successfully!!');
    } catch (\Exception $e) {
      report($e);
      return redirect()->back()->with('error', 'Something goes wrong while sending notification.');
    }
  }

  public function SendPushNotification(Request $request)
  {
    $title = $request->input('title');
    $message = $request->input('message');
    $fcmTokens = $request->input('fcm_tokens');

    Notification::send(null, new SendPushNotification($title, $message, $fcmTokens));

    return response()->json(['success' => true]);
  }
}
