<?php

namespace App\Policies;

use App\User;
use App\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
	use HandlesAuthorization;

	public function before($user, $ability)
	{
		if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
			return true;
		}
	}

	/**
	 * Determine whether the user can view the Product.
	 *
	 * @param  App\User  $user
	 * @param  App\Product  $product
	 * @return mixed
	 */
	public function view(User $user, Product $product)
	{
		return $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can create Productcategories.
	 *
	 * @param  App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can update the Product.
	 *
	 * @param  App\User  $user
	 * @param  App\Product  $product
	 * @return mixed
	 */
	public function update(User $user, Product $product)
	{
		return $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can delete the Product.
	 *
	 * @param  App\User  $user
	 * @param  App\Product  $product
	 * @return mixed
	 */
	public function delete(User $user, Product $product)
	{
		return $user->hasRoles('Moderator');
	}
}
