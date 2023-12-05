<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('username', $request['username'])->first();
        if ($user && Hash::check($request['password'], $user->password)) {
            $token =  $user->createToken($request['device_name'])->plainTextToken;
            return Response::SendResponse(200, 'User logged in successfully',['token'=>$token]);
        }

        $response = Response::SendResponse(401, 'You can not login','Invalid Username/Password');
        throw new HttpResponseException($response);
    }
}
