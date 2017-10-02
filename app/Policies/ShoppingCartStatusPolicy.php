<?php

namespace App\Policies;

use App\User;
use App\ShoppingCartStatus;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShoppingCartStatusPolicy
{
	use HandlesAuthorization;

	public function before($user, $ability)
	{
		if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
			return true;
		}
	}

	/**
	 * Determine whether the user can view the shoppingCartStatus.
	 *
	 * @param  \App\User  $user
	 * @param  \App\ShoppingCartStatus  $shoppingCartStatus
	 * @return mixed
	 */
	public function view(User $user, ShoppingCartStatus $shoppingCartStatus)
	{
		return $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can create shoppingCartStatuses.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can update the shoppingCartStatus.
	 *
	 * @param  \App\User  $user
	 * @param  \App\ShoppingCartStatus  $shoppingCartStatus
	 * @return mixed
	 */
	public function update(User $user, ShoppingCartStatus $shoppingCartStatus)
	{
		return $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can delete the shoppingCartStatus.
	 *
	 * @param  \App\User  $user
	 * @param  \App\ShoppingCartStatus  $shoppingCartStatus
	 * @return mixed
	 */
	public function delete(User $user, ShoppingCartStatus $shoppingCartStatus)
	{
		return $user->hasRoles('Moderator');
	}
}
