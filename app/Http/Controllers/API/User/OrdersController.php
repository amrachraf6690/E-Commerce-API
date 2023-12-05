<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('user_order')->only('show');
    }

    public function index()
    {

        $orders = auth()->user()->orders()->with('product')->get();
        return  Response::SendResponse(200,"Here's your orders",[
            'count'=>$orders->count(),
            'paid'=>number_format($orders->sum('product.price')/100,3).' EGP',
            'orders'=>OrderResource::collection($orders)]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function store(OrderRequest $request)
    {
        $order = auth()->user()->orders()->create($request->only('product_id','address_id'));
        return Response::SendResponse(200,'Order Placed Successfully',['order_id'=>$order->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param $order
     * @return JsonResponse
     */
    public function show($orderID)
    {
        $order = Order::find($orderID);

        return Response::SendResponse(200,'Here is your order',new OrderResource($order));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
