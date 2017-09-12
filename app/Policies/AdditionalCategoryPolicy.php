<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdditionalCategoryPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the AdditionalCategory.
     *
     * @param  App\User  $user
     * @param  App\AdditionalCategory  $additionalCategory
     * @return mixed
     */
    public function view(User $user, AdditionalCategory $additionalCategory)
    {
        return false;
    }

    /**
     * Determine whether the user can create articlecategories.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the AdditionalCategory.
     *
     * @param  App\User  $user
     * @param  App\AdditionalCategory  $additionalCategory
     * @return mixed
     */
    public function update(User $user, AdditionalCategory $additionalCategory)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the AdditionalCategory.
     *
     * @param  App\User  $user
     * @param  App\AdditionalCategory  $additionalCategory
     * @return mixed
     */
    public function delete(User $user, AdditionalCategory $additionalCategory)
    {
        return false;
    }
}
