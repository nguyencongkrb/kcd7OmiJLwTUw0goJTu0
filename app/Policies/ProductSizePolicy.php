<?php

namespace App\Policies;

use App\User;
use App\ProductSize;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductSizePolicy
{
	use HandlesAuthorization;

	public function before($user, $ability)
	{
		if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
			return true;
		}
	}

	/**
	 * Determine whether the user can view the ProductSize.
	 *
	 * @param  App\User  $user
	 * @param  App\ProductSize  $productsize
	 * @return mixed
	 */
	public function view(User $user, ProductSize $productsize)
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
	 * Determine whether the user can update the ProductSize.
	 *
	 * @param  App\User  $user
	 * @param  App\ProductSize  $productsize
	 * @return mixed
	 */
	public function update(User $user, ProductSize $productsize)
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the ProductSize.
	 *
	 * @param  App\User  $user
	 * @param  App\ProductSize  $productsize
	 * @return mixed
	 */
	public function delete(User $user, ProductSize $productsize)
	{
		return false;
	}
}
