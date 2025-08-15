<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserInfoController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $users = User::with('profile')->get();
        $data = [];
        foreach ($users as $user) {
            $data[] = $user->profile;
        }

        return $data;
    }
}
