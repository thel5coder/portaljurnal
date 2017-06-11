<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request){
        $response = $this->userService->AddUser($request->all());

        return $this->getJsonResponse($response);
    }

    public function login(Request $request){
        $response = $this->userService->Autentikasi($request->get('email'),$request->get('password'),$request->get('remember'));

        return $this->getJsonResponse($response);
    }

    public function logout(){
        Auth::logout();

        return response('berhasil logout',200);
    }

    public function pagination(){
        return response()->json('pagination',200);
    }

    public function nyoba(){
        return response()->json(['coba'=>'1']);
    }
}
