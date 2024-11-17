<?php

namespace App\Http\Controllers\Api;

use App\Common\ResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\LoginRequest;
use App\Http\Requests\Api\User\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    protected $userService;
    protected $responseClass;

    public function __construct(
        UserService $userService,
        ResponseClass $responseClass
    ){
        $this->userService = $userService;
        $this->responseClass = $responseClass;
    }

    public function signIn(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return $this->responseClass->apiResponse(422, 'The provided credentials are incorrect', ['email' => ['The provided credentials are incorrect.']]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            $data = [
                'user' => new UserResource($user),
                'access_token' => $token,
                'token_type' => "Bearer",
            ];

            return $this->responseClass->apiResponse(200, 'Login successful', null, $data);
        } catch (\Exception $e){
            Log::error($e->getMessage());
            return $this->responseClass->apiResponse(500, 'Something Went wrong!', null, null);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->responseClass->apiResponse(200, 'Logged out successfully');
    }
}

