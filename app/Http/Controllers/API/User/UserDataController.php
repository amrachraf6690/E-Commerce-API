<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        return Response::SendResponse(200,'Here is your data',
            [
                'user'=>auth()->user(),
                'addresses_count'=>auth()->user()->addresses()->count(),
                'addresses'=>auth()->user()->addresses()->get(),
                'orders_count'=>auth()->user()->orders()->count(),
                'orders'=>auth()->user()->orders()->get(),
            ]);
    }
}
