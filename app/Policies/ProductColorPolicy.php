<?php

namespace App\Policies;

use App\User;
use App\ProductColor;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductColorPolicy
{
	use HandlesAuthorization;

	public function before($user, $ability)
	{
		if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
			return true;
		}
	}

	/**
	 * Determine whether the user can view the ProductColor.
	 *
	 * @param  App\User  $user
	 * @param  App\ProductColor  $productcolor
	 * @return mixed
	 */
	public function view(User $user, ProductColor $productcolor)
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
	 * Determine whether the user can update the ProductColor.
	 *
	 * @param  App\User  $user
	 * @param  App\ProductColor  $productcolor
	 * @return mixed
	 */
	public function update(User $user, ProductColor $productcolor)
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the ProductColor.
	 *
	 * @param  App\User  $user
	 * @param  App\ProductColor  $productcolor
	 * @return mixed
	 */
	public function delete(User $user, ProductColor $productcolor)
	{
		return false;
	}
}
