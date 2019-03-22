<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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
            $user = $this->guard()->user();
            $user->token_state = 'on';
            $user->save();

            return $this->success(['message' => 'Ingreso satisfactorio.', 'token' => $user->token]);
        }

        return $this->bad(['message' => 'Datos de acceso incorrectos.']);

    }

    public function logout(Request $request){
        $this->guard()->logout();
        $token = $request->bearerToken() ?: $request->token;

        $user = User::where(['token_state' => 'on', 'token' => $token])->first();
        if($user){
            $user->token_state = 'off';
            $user->save();
            return $this->success(['message' => 'Cierre de sesion satisfactorio.']);
        }

        return $this->bad();
    }
}
