<?php

namespace App\Policies;

use App\User;
use App\ProductType;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductTypePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the ProductType.
     *
     * @param  App\User  $user
     * @param  App\ProductType  $producttype
     * @return mixed
     */
    public function view(User $user, ProductType $producttype)
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
     * Determine whether the user can update the ProductType.
     *
     * @param  App\User  $user
     * @param  App\ProductType  $producttype
     * @return mixed
     */
    public function update(User $user, ProductType $producttype)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the ProductType.
     *
     * @param  App\User  $user
     * @param  App\ProductType  $producttype
     * @return mixed
     */
    public function delete(User $user, ProductType $producttype)
    {
        return false;
    }
}
