<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Http\Requests\UserLoginRequest;
use Modules\Admin\Http\Requests\UserRegisterRequest;
use Modules\Admin\Services\UserService;
use Modules\Admin\Transformers\AuthResource;
use Modules\Admin\Transformers\SuccessResource;

class AuthController extends BaseController
{
    /** @var UserService  */
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Register
     *
     * @param UserRegisterRequest $request
     * @return SuccessResource
     */
    public function store(UserRegisterRequest $request): SuccessResource
    {
        $result =  $this->userService->store($request);

        return SuccessResource::make($result);
    }

    /**
     * User login
     *
     * @param UserLoginRequest $request
     * @return SuccessResource
     */
    public function login(UserLoginRequest $request)
    {
        $result = $this->userService->login($request->all());

        return AuthResource::make($result);
    }

    /**
     * logout
     *
     * @return SuccessResource
     */
    public function logout(): SuccessResource
    {
        $this->userService->logout();

        return SuccessResource::make();
    }

    /**
     * Forgot password by email
     *
     * @param ForgotPasswordRequest $request
     * @return SuccessResource
     */
    public function forgotPassword(ForgotPasswordRequest $request): SuccessResource
    {
        $result = $this->userService->forgotPassword($request->onlyFields());

        return SuccessResource::make($result);
    }

    /**
     * Reset password
     *
     * @param PasswordResetRequest $request
     * @return SuccessResource
     */
    public function resetPassword(PasswordResetRequest $request): SuccessResource
    {
        $this->userService->resetPassword($request->onlyFields());

        return SuccessResource::make();
    }
}
