<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\traits\ApiTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

// use Laravel\Sanctum\HasApiTokens;


class LoginController extends Controller
{
    use HasApiTokens;

    use ApiTrait;
    //
    function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        // dd(Hash::check($user->password, $request->password));
        // ifفي هنا ايرور ان شرط ال
        // بتاع الهاش بيدي فولص وعملت تشيك علي الباس اللي داخل الداتابيز في الريجستر كونترولر  وطلع مظبوط وكذلك هنا برضو بعمل تشيك علي الباس اللي جاي مالريكويست ومظبوط
        // dd($request->password);
        // dd($user);
        if (!$user && !Hash::check($request->password, $user->password)) {
            return $this->ErrorMessage([], 'password error');
        } else {
            if (is_null($user->email_verified_at)) {
                return $this->Data(compact('user'), 'user not verified', 401);
            }
            $user->token =  $user->createToken($request->device_name)->plainTextToken;
            return $this->Data(compact('user'), 'logged in');
        }

        // if (is_null($user->email_verified_at)) {
        //     return $this->Data(compact('user'), 'user not verified', 401);
        // }

    }
    function logout(Request $request)
    {
        $token = $request->header('Authorization');
        $id1 = explode('Bearer ', $token)[1];
        $id2 = explode('|', $id1)[0];
        // dd($id2);
        $auth = Auth::guard('sanctum')->user();
        $auth->tokens()->where('id', $id2)->delete();
        return $this->SuccessMessage('logged out');


        // dd($auth);
        // dd($request);
        // $request->user()->currentAccessToken()->delete();
    }
    function logout_All_Devices()
    {

        // $token = $request->header('Authorization');
        // dd($token);
        $auth = Auth::guard('sanctum')->user();
        // dd($auth);
        $auth->tokens()->delete();
        return $this->SuccessMessage('logged out from all devices');
    }
}
