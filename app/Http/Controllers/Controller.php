<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success($arr = ['message' => 'Operacion realizada correctamente.']){
        return response()->json($arr ,200);
    }

    public function successRegister($arr = ['message' => 'Registrado correctamente.']){
        return response()->json($arr,201);
    }

    public function bad($arr = ['message' => 'Informacion no procesada.']){
        return response()->json($arr, 422);
    }
}
