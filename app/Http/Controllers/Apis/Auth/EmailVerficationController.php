<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Http\Requests\CheckCodeRequest;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Http\traits\ApiTrait;
use App\Models\User;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Http\traits\media;
use App\Mail\EmailVerfication;
use DateTime;

class EmailVerficationController extends Controller
{
    use ApiTrait;
    //
    function sendCode(Request $request)
    {

        $token = $request->header('Authorization');

        $auth = Auth::guard('sanctum')->user();
        // dd($auth);
        $code = rand(10000, 99999);
        // dd(getdate());
        $expired_data = date('20y-m-d h:i:s', strtotime('+3 minutes'));
        // dd($expired_data);
        // $expired_data = datetime();


        // dd($expired_data);
        $user = User::find($auth->id);
        $user->code = $code;
        $user->code_expired_at = $expired_data;
        // dd($user->code_expired_at);
        $user->save();
        $user->token = $token;
        Mail::to($user->email)->send(new EmailVerfication($user));
        return $this->Data(compact('user'), 'seccess', 201);
    }
    function checkCode(CheckCodeRequest $request)
    {
        $token = $request->header('Authorization');
        $auth = Auth::guard('sanctum')->user();
        // dd($auth);
        $user = User::find($auth->id);
        // dd($user);
        // dd(date('20y-m-d h:i:s'), $user->code_expired_at);
        // dd($user->code, $request->code);

        if ($user->code == $request->code) {
            # code...

            if ($user->code_expired_at > date('20y-m-d h:i:s')) {
                # code..
                // dd(date('y-m-d h:i:s'));
                $user->email_verified_at = date('20y-m-d h:i:s');
                $user->save();
                $user->token = $token;
                return $this->Data(compact('user'), 'seccess', 201);
            } else {
                echo 'date';
            }
        } else {
            return $this->Data(compact('user'), 'faild', 401);
        }
    }
}
