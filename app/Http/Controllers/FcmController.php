<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Firebase\Messaging\FirebaseMessaging;

class FcmController extends Controller
{
    // public function storeToken(Request $request)
    // {
    //     // Validate request
    //     $request->validate([
    //         'token' => 'required|string'
    //     ]);

    //     // Store token in database (implement your logic)
    //     $user = User::find(auth()->id()); // Replace with your user model access logic
    //     $user->fcm_token = $request->token;
    //     $user->save();

    //     return response()->json([
    //         'success' => true,
    //     ]);
    // }

    // public function sendNotification(Request $request)
    // {
    //     $data = $request->json()->all();

    //     $notification = [
    //         'title' => $data['title'],
    //         'body' => $data['body'],
    //         'data' => $data['data'],
    //     ];

    //     $user = new User();
    //     $user->send($notification, "AAAAKwH1jzY:APA91bG5HMhglUdJgtirNBIt-xOdkh5abOCctj-iHlcvxnSYmGSaekvdycE_bXWgxvLYTGEdzxHY2Xx-mhRXdSz3XrBHIbKdxpnHff61Gr06bsQysp26Hqdwn3yZVlBSHEAZN7HlrnJW"); // Ganti dengan key server FCM Anda

    //     return response()->json([
    //         'success' => true,
    //     ]);
    // }

    public function send(Request $request)
    {
        // Get notification data from request
        $notification = $request->json()->all();

        // Get Firebase Messaging instance
        $messaging = new FirebaseMessaging();

        // Prepare notification message
        $message = [
            'notification' => $notification,
            'token' => 'YOUR_ADMIN_FCM_TOKEN',
        ];

        // Send notification
        $messaging->send($message);

        return response()->json([
            'success' => true,
            'message' => 'Notification sent successfully',
        ]);
    }
}
