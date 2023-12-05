<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Jobs\SendWelcomeEmail;
use App\Mail\Welcome;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function __invoke(RegisterRequest $request)
    {
        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->validated());

        $token = $user->createToken('token_name')->plainTextToken;

        SendWelcomeEmail::dispatch($user)->onQueue('emails');

        return Response::sendResponse(201, 'User created successfully', ['token' => $token]);
    }

}
