<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AddressesController extends Controller
{

    public function __construct()
    {
        $this->middleware('user_address')->only(['show','update','destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $addresses = auth()->user()->addresses()->get();
        return  Response::SendResponse(200,"Here's your addresses",[
            'count'=>$addresses->count(),
            'addresses'=>AddressResource::collection($addresses)]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param AddressRequest $request
     * @return JsonResponse
     */
    public function store(AddressRequest $request)
    {
        $address = auth()->user()->addresses()->create($request->validated());
        return Response::SendResponse(200,'Your address has been saved successfully',new AddressResource($address));
    }

    /**
     * Display the specified resource.
     *
     * @param $AddressID
     * @return JsonResponse
     */
    public function show($AddressID)
    {

        $order = Address::find($AddressID);

        return Response::SendResponse(200,'Here is your address',new AddressResource($order));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param AddressRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(AddressRequest $request,$id)
    {
        Address::find($id)->update($request->validated());

        return Response::SendResponse(200,'You address has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        Address::find($id)->delete();

        return Response::SendResponse(200,'You address has been deleted successfully');
    }
}
