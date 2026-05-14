<?php

namespace App\Policies;

use App\Models\Resource as UserResource;
use App\Models\User;

class ResourcePolicy
{
    public function update(User $user, UserResource $resource): bool
    {
        return $user->id === $resource->user_id;
    }

    public function delete(User $user, UserResource $resource): bool
    {
        return $user->id === $resource->user_id;
    }
}
