<?php

namespace App\Policies;

use App\User;
use App\ArticleType;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticleTypePolicy
{
	use HandlesAuthorization;

	public function before($user, $ability)
	{
		if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
			return true;
		}
	}

	/**
	 * Determine whether the user can view the ArticleType.
	 *
	 * @param  App\User  $user
	 * @param  App\ArticleType  $articletype
	 * @return mixed
	 */
	public function view(User $user, ArticleType $articletype)
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
	 * Determine whether the user can update the ArticleType.
	 *
	 * @param  App\User  $user
	 * @param  App\ArticleType  $articletype
	 * @return mixed
	 */
	public function update(User $user, ArticleType $articletype)
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the ArticleType.
	 *
	 * @param  App\User  $user
	 * @param  App\ArticleType  $articletype
	 * @return mixed
	 */
	public function delete(User $user, ArticleType $articletype)
	{
		return false;
	}
}
