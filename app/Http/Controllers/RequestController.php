<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Models\User; // Jika relasi user didefinisikan di model RequestUser
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;

use Kreait\Firebase\Messaging\FirebaseMessaging;
use Firebase\Messaging\Message;

class RequestController extends Controller
{
  /**
   * Menyimpan permintaan baru.
   *
   * @param  HttpRequest  $request
   * @return \Illuminate\Http\JsonResponse
   */
  // public function store(HttpRequest $request)
  // {
  //   $validator = Validator::make($request->all(), [
  //     'user_id' => 'required|exists:users,id',
  //     'item_name' => 'required|string',
  //     'quantity' => 'required|integer',
  //   ]);

  //   if ($validator->fails()) {
  //     return response()->json($validator->errors(), 422);
  //   }

  //   $validatedData = $validator->validated();

  //   $requests = Request::create($validatedData);

  //   // Kirim notifikasi FCM ke admin
  //   $this->sendNotificationToAdmin($requests);

  //   return response()->json($requests, 201);
  // }

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
}
