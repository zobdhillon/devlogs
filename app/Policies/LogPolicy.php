<?php

namespace App\Policies;

use App\Models\Log;
use App\Models\User;

class LogPolicy
{
    public function update(User $user, Log $log): bool
    {
        return $user->id === $log->user_id;
    }

    public function delete(User $user, Log $log): bool
    {
        return $user->id === $log->user_id;
    }
}
