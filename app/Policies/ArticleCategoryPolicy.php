<?php

namespace App\Policies;

use App\User;
use App\ArticleCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticleCategoryPolicy
{
	use HandlesAuthorization;

	public function before($user, $ability)
	{
		if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
			return true;
		}
	}

	/**
	 * Determine whether the user can view the articlecategory.
	 *
	 * @param  App\User  $user
	 * @param  App\ArticleCategory  $articlecategory
	 * @return mixed
	 */
	public function view(User $user, ArticleCategory $articlecategory)
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
	 * Determine whether the user can update the articlecategory.
	 *
	 * @param  App\User  $user
	 * @param  App\ArticleCategory  $articlecategory
	 * @return mixed
	 */
	public function update(User $user, ArticleCategory $articlecategory)
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the articlecategory.
	 *
	 * @param  App\User  $user
	 * @param  App\ArticleCategory  $articlecategory
	 * @return mixed
	 */
	public function delete(User $user, ArticleCategory $articlecategory)
	{
		return false;
	}
}
