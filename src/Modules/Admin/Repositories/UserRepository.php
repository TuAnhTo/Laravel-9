<?php

namespace Modules\Admin\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository
{
    /**
     * Find by id
     *
     * @param int $userId
     * @return User|null
     */
    public function findById(int $userId): ?User
    {
        return User::withTrashed()
            ->find($userId);
    }

    /**
     * Find by email
     *
     * @param string $email
     * @return object|null
     */
    public function findByEmail(string $email): ?User
    {
        return User::query()->where([
            'email' => $email
        ])->first();
    }

    /**
     * Create or update host
     *
     * @param string $email
     * @param array $attributes
     * @return User|Model
     */
    public function createOrUpdate(string $email, array $attributes): Model|User
    {
        return User::query()->updateOrCreate(
            ['email' => $email],
            $attributes
        );
    }
}
