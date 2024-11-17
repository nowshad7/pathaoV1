<?php

namespace App\Http\Controllers\Api;

use App\Common\ResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;
    protected $responseClass;

    public function __construct(UserService $userService, ResponseClass $responseClass)
    {
        $this->userService = $userService;
        $this->responseClass = $responseClass;
    }

    public function show($id)
    {
        $user = $this->userService->findUser($id);

        if ($user) {
            return $this->responseClass->apiResponse(200, 'User retrieved successfully', null, new UserResource($user));
        }

        return $this->responseClass->apiResponse(404, 'User not found');
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userService->findUser($id);

        if ($user) {
            $user = $this->userService->updateUser($user, $request->validated());
            return $this->responseClass->apiResponse(200, 'User updated successfully', null, new UserResource($user));
        }

        return $this->responseClass->apiResponse(404, 'User not found');
    }

    public function destroy($id)
    {
        $user = $this->userService->findUser($id);

        if ($user) {
            $this->userService->deleteUser($user);
            return $this->responseClass->apiResponse(204, 'User deleted successfully');
        }

        return $this->responseClass->apiResponse(404, 'User not found');
    }
}
