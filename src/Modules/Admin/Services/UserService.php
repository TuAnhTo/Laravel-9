<?php

namespace Modules\Admin\Services;


use App\Exceptions\ApiException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Http\Requests\UserRegisterRequest;
use Modules\Admin\Repositories\UserRepository;
use Tymon\JWTAuth\Facades\JWTAuth;
use UserStatus;


class UserService
{
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Register user
     *
     * @param UserRegisterRequest $request
     * @return User
     */
    public function store(UserRegisterRequest $request): User
    {
        $user = $this->userRepository->findByEmail($request->get('email'));
        $body = $request->all();

        if ($user) {
            throw ApiException::badRequest('User is already exist');
        }
        $storeId = $this->genStoreId('st_');

        $body['password'] = Hash::make($body['password']);
        $email = $body['email'];
        $body['store_id'] = $storeId;

        unset($body['email']);

        return $this->userRepository->createOrUpdate($email, $body);
    }

    /**
     * Change password
     *
     * @param array $body
     * @return void
     */
    public function changePassword(array $body): array
    {
        return [];
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        Auth::guard('admin')->logout();
    }

    /**
     * Login host
     *
     * @param array $body
     * @return array
     */
    public function login(array $body): array
    {
        $user = $this->userRepository->findByEmail($body['email']);

        if($user && $user->deleted_at) {
            throw ApiException::badRequest('Account disable');
        }

        $attempt = Auth::guard('api')->attempt([
            'email'     => $body['email'],
            'password'  => $body['password']
        ]);

        if(!$attempt) {
            throw ApiException::unauthorized(trans('auth.failed'));
        }

        $user = Auth::guard('api')->user();
        $status = 1;

        if (!$token = JWTAuth::fromUser($user)) {
            throw ApiException::unauthorized();
        }

        return $this->createNewToken($token, $status);
    }

    /**
     * @param array $body
     * @return array
     */
    public function verify(array $body)
    {
        return [];
    }

    /**
     * Forgot password by email
     *
     * @param array $body
     * @return array
     */
    public function forgotPassword(array $body): array
    {
        return [];
    }

    /**
     * Verify forgot password by email
     *
     * @param array $body
     * @return array
     */
    public function verifyForgotPassword(array $body): array
    {
        return [];
    }

    /**
     * Reset password by email
     *
     * @param array $body
     */
    public function resetPassword(array $body): void
    {
        return;
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     * @param string $status
     * @return array
     */
    protected function createNewToken(string $token, string $status): array
    {
        return [
            'access_token' => $token,
            'account_status' => $status,
        ];
    }

    /**
     * Update profile
     *
     * @param array $body
     * @return Host
     */
    public function update(array $body): array
    {
        return [];
    }

    /**
     * @param string $prefix
     * @return string
     */
    function genStoreId(string $prefix): string
    {
        $n = 16;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $prefix . $randomString;
    }
}
