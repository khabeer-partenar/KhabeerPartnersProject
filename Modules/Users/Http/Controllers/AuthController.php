<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Modules\Users\Entities\User;
use Validator;

class AuthController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Display a login form of users
     * @return Response
     */
    public function showLoginForm()
    {
        return view('users::auth.login');
    }

    /**
     * Validate the login of the user
     * @return Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'national_id' => 'required'
        ]);

        if ($validator->fails()) {

            if($request->call_type == 'api') {
                return response()->json($validator->messages(), 401);
            }

            return redirect()->route('login')->withErrors($validator)->with('error_login', 'invalid_login');
        }

        $userData = User::where(['national_id' => $request->national_id])->first();

        if($request->national_id == 1000000001 && $request->password != '0000') {
            return redirect()->route('login')->withInput($request->except('password'))->with('error_login', 'invalid_login');
        }

        if ($userData != false) {
            auth()->login($userData, true);

            if($request->call_type == 'api') {
                $token = $userData->createToken('APIAPP')->accessToken;
                return response()->json(['token' => $token], 200);
            }

            return redirect()->to($this->redirectTo);
        }

        if($request->call_type == 'api') {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
        
        return redirect()->route('login')->withInput($request->except('password'))->with('error_login', 'invalid_login');
    }


}
