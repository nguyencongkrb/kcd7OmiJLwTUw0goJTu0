<?php

namespace App\Policies;

use App\User;
use App\ShoppingCart;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShoppingCartPolicy
{
	use HandlesAuthorization;

	public function before($user, $ability)
	{
		if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
			return true;
		}
	}

	/**
	 * Determine whether the user can view the shoppingCart.
	 *
	 * @param  \App\User  $user
	 * @param  \App\ShoppingCart  $shoppingCart
	 * @return mixed
	 */
	public function view(User $user, ShoppingCart $shoppingCart)
	{
		return $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can create shoppingCarts.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can update the shoppingCart.
	 *
	 * @param  \App\User  $user
	 * @param  \App\ShoppingCart  $shoppingCart
	 * @return mixed
	 */
	public function update(User $user, ShoppingCart $shoppingCart)
	{
		return $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can delete the shoppingCart.
	 *
	 * @param  \App\User  $user
	 * @param  \App\ShoppingCart  $shoppingCart
	 * @return mixed
	 */
	public function delete(User $user, ShoppingCart $shoppingCart)
	{
		return $user->hasRoles('Moderator');
	}
}
