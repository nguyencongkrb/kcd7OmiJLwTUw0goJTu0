<?php

namespace App\Policies;

use App\User;
use App\BannerCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class BannerCategoryPolicy
{
	use HandlesAuthorization;

	public function before($user, $ability)
	{
		if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
			return true;
		}
	}

	/**
	 * Determine whether the user can view the bannercategory.
	 *
	 * @param  App\User  $user
	 * @param  App\BannerCategory  $bannercategory
	 * @return mixed
	 */
	public function view(User $user, BannerCategory $bannercategory)
	{
		return false;
	}

	/**
	 * Determine whether the user can create bannercategories.
	 *
	 * @param  App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return false;
	}

	/**
	 * Determine whether the user can update the bannercategory.
	 *
	 * @param  App\User  $user
	 * @param  App\BannerCategory  $bannercategory
	 * @return mixed
	 */
	public function update(User $user, BannerCategory $bannercategory)
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the bannercategory.
	 *
	 * @param  App\User  $user
	 * @param  App\BannerCategory  $bannercategory
	 * @return mixed
	 */
	public function delete(User $user, BannerCategory $bannercategory)
	{
		return false;
	}
}
