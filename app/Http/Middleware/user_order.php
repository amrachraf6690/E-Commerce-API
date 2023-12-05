<?php

namespace App\Http\Middleware;

use App\Http\Controllers\API\Response;
use App\Models\Order;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class user_order
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $orderId = $request->route('order');

        $order = Order::find($orderId);

        if (!$order || auth()->id() !== $order->user_id) {
            return Response::SendResponse(403, 'You are not authorized to view that order');
        }

        return $next($request);
    }
}
