<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
	public function register(Request $request)
	{
		$validatedData = request()->validate([
			'name' => 'required|min:3',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:8',
		]);
		$validatedData['password'] = bcrypt($request->password);
		$user = User::create($validatedData);
		$accessToken = $user->createToken('authToken')->accessToken;
		return response(['user' => $user, 'access_token' => $accessToken]);
	}

	public function login(Request $request)
	{
		$loginData = $request->validate([
			'email' => 'email|required',
			'password' => 'required'
		]);
		if (!auth()->attempt($loginData)) {
			return response(['message' => 'Invalid Credentials']);
		}
		$accessToken = auth()->user()->createToken('authToken')->accessToken;
		return response(['user' => auth()->user(), 'access_token' => $accessToken]);
	}
}
