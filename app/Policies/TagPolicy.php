<?php

namespace App\Policies;

use App\User;
use App\Tag;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
	use HandlesAuthorization;

	public function before($user, $ability)
	{
		if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
			return true;
		}
	}

	/**
	 * Determine whether the user can view the Tag.
	 *
	 * @param  App\User  $user
	 * @param  App\Tag  $tag
	 * @return mixed
	 */
	public function view(User $user, Tag $tag)
	{
		return $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can create articlecategories.
	 *
	 * @param  App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can update the Tag.
	 *
	 * @param  App\User  $user
	 * @param  App\Tag  $tag
	 * @return mixed
	 */
	public function update(User $user, Tag $tag)
	{
		return $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can delete the Tag.
	 *
	 * @param  App\User  $user
	 * @param  App\Tag  $tag
	 * @return mixed
	 */
	public function delete(User $user, Tag $tag)
	{
		return $user->hasRoles('Moderator');
	}
}
