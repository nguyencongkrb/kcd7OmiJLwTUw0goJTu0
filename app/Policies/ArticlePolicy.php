<?php

namespace App\Policies;

use App\User;
use App\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
	use HandlesAuthorization;

	public function before($user, $ability)
	{
		if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
			return true;
		}
	}

	/**
	 * Determine whether the user can view the Article.
	 *
	 * @param  App\User  $user
	 * @param  App\Article  $article
	 * @return mixed
	 */
	public function view(User $user, Article $article)
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
	 * Determine whether the user can update the Article.
	 *
	 * @param  App\User  $user
	 * @param  App\Article  $article
	 * @return mixed
	 */
	public function update(User $user, Article $article)
	{
		return $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can delete the Article.
	 *
	 * @param  App\User  $user
	 * @param  App\Article  $article
	 * @return mixed
	 */
	public function delete(User $user, Article $article)
	{
		return $user->hasRoles('Moderator');
	}
}
