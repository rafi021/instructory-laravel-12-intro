<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserInfoController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $secret_key = 12345;
        $user_key = $request->input('user_key');

        $data = [
            "name" => "Mahmud Ibrahim",
            "mobile" => "01700000000",
            "bank_acc" => '1231230912839162761287'
        ];

        if ($user_key == $secret_key) {
            return response()->json([
                'message' => 'Access granted',
                'user_info' => $data
            ]);
        } else {
            return response()->json([
                'message' => 'Access denied',
            ]);
        }
    }
}
