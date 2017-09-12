<?php

namespace App\Policies;

use App\User;
use App\Banner;
use Illuminate\Auth\Access\HandlesAuthorization;

class BannerPolicy
{
	use HandlesAuthorization;

	public function before($user, $ability)
	{
		if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
			return true;
		}
	}

	/**
	 * Determine whether the user can view the banner.
	 *
	 * @param  App\User  $user
	 * @param  App\Banner  $banner
	 * @return mixed
	 */
	public function view(User $user, Banner $banner)
	{
		return $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can create banners.
	 *
	 * @param  App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can update the banner.
	 *
	 * @param  App\User  $user
	 * @param  App\Banner  $banner
	 * @return mixed
	 */
	public function update(User $user, Banner $banner)
	{
		return $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can delete the banner.
	 *
	 * @param  App\User  $user
	 * @param  App\Banner  $banner
	 * @return mixed
	 */
	public function delete(User $user, Banner $banner)
	{
		return $user->hasRoles('Moderator');
	}
}
