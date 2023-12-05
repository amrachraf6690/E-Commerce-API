<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Response extends Controller
{

    public function SendResponse($code,$message,$data = null){
        $response = [
            'status_code'=>$code,
            'message'=>$message,
            'data'=>$data
        ];
        return response()->json($response,$code);
    }
}
