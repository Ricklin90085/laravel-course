<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(CreateUser $request)
    {
        $form = $request->validated();

        $user = User::create(['name' => $form['name'],
                            'email' => $form['email'],
                            'password' => bcrypt($form['password'])]);

        return response('success', 201);
    }

    public function login(Request $request)
    {
        // 驗證資料格式
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        // Auth::attempt 會認證使用者，並自動將資料庫內經過加密的密碼跟傳入的 password 值做比對
        if (!Auth::attempt($validatedData)) {
            return response('授權失敗', 401);
        }

        // 驗證結束後會自動把 user 塞進 $request
        $user = $request->user();
        $token = $user->createToken('Token');
        // 將 token 儲存至資料庫
        $token->token->save();

        return response()->json([
            'token' => $token->accessToken
        ]);
    }

    public function logout(Request $request)
    {
        // 撤除 token
        $request->user()->token()->revoke();
        return response([ 'message' => '登出成功' ]);
    }

    public function user(Request $request)
    {
        return response($request->user());
    }
}
