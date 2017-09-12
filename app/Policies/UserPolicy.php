<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
	use HandlesAuthorization;

	public function before($user, $ability)
	{
		if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
			return true;
		}
	}

	/**
	 * Determine whether the user can view the user.
	 *
	 * @param  App\User  $user
	 * @param  App\User  $user
	 * @return mixed
	 */
	public function view(User $user, User $editUser)
	{
		return $user->id === $editUser->id;
	}

	/**
	 * Determine whether the user can create users.
	 *
	 * @param  App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return false;
	}

	/**
	 * Determine whether the user can update the user.
	 *
	 * @param  App\User  $user
	 * @param  App\User  $user
	 * @return mixed
	 */
	public function update(User $user, User $editUser)
	{
		return $user->id === $editUser->id;
	}

	/**
	 * Determine whether the user can delete the user.
	 *
	 * @param  App\User  $user
	 * @param  App\User  $user
	 * @return mixed
	 */
	public function delete(User $user, User $editUser)
	{
		return false;
	}

	public function filter(User $user, User $editUser)
	{
		return false;
	}

	public function toggleActive(User $user, User $editUser)
	{
		return false;
	}

	public function profile(User $user, User $editUser)
	{
		return $user->id === $editUser->id;
	}

	public function passwordChange(User $user, User $editUser)
	{
		return $user->id === $editUser->id;
	}
}
