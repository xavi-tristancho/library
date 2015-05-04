<?php namespace Library\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Library\Users\User;
use Tymon\JWTAuth\Exceptions\JWTException;

class SessionsController extends ApiController{

    public function register(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            $user = User::create($credentials);
        } catch (\Exception $e) {
            return $this->respondFailedValidation('The User already exists');
        }

        $token = JWTAuth::fromUser($user);

        return $this->respond(['token' => $token]);
    }

    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('username', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->respondUnauthorized('Invalid Credentials');
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }
} 