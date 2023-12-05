<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        auth()->user()->currentAccessToken()->delete();

        return Response::SendResponse(200,'You has been logged out successfully');
    }
}
