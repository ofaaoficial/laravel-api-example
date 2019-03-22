<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request){
        $v = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if($v->fails()) return response()->json($v->errors(), 400);

        if($this->attemptLogin($request)){
            $user = User::where('username', $request->username)->first();
            $user->token_state = 'on';
            $user->save();

            return response()->json(['message' => 'Ingreso satisfactorio.', 'token' => $user->token], 200);
        }else{
            return response()->json(['message' => 'Datos de acceso incorrectos.'], 400);
        }


    }
}
