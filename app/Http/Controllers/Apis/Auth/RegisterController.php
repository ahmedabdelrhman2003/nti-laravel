<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Http\traits\ApiTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use ApiTrait;
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        // dd($request->all());

        $data = $request->except('password');
        // $data = $request;
        // dd($data->password);

        $data['password'] = Hash::make($request->Password);
        // $data['password'] = $request->Password;



        // dd($data['password']);
        $user = User::create($data);
        $user->token = 'Bearer ' . $user->createToken($request->device_name)->plainTextToken;
        return $this->Data(compact('user'), "success");
    }
}
