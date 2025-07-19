<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    /**
     * Register user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => '|required|string|max:50',
            'surname' => '|required|string|max:50',
            'email' => 'required|unique:users|email',
            'username' => [
                'required',
                'unique:users',
                'max:20',
                'regex:/^[a-z0-9]+$/'
            ],
            'password' => 'required|min:8|max:20',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['role_id'] = 2; // Add the "subscriber" role.
        $user = User::create($input);

        $success['name'] =  $user->name;
        $success['surname'] = $user->surname;
        $success['email'] = $user->email;
        $success['username'] = $user->username;

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->all('email', 'password');

        $token = auth('api')->attempt($credentials);

        if($token){
//            $user = Auth::user();
//            $success['name'] =  $user->name;
//            $success['surname'] = $user->surname;
//            $success['email'] = $user->email;
//            $success['username'] = $user->username;
            $success['token'] =  $token;

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError('Login failed.', ['error'=>'Invalid email or password.']);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token = auth('api')->refresh();
        return response()->json(['token' => $token]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Update user data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validateData = $request->validate([
           'name' => 'sometimes|required|string|max:50',
           'surname' => 'sometimes|required|string|max:50',
        ]);

        $user = $request->user();
        $user->update($validateData);

        return response()->json(['message' => 'User data updated successfully']);
    }
}
