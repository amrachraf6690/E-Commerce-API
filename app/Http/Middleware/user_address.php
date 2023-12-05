<?php

namespace App\Http\Middleware;

use App\Http\Controllers\API\Response;
use App\Models\Address;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class user_address
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $addressID = $request->route('address');

        $address = Address::find($addressID);

        if (!$address || auth()->id() !== $address->user_id) {
            return Response::SendResponse(403, 'You are not authorized to view that address');
        }

        return $next($request);
    }
}
