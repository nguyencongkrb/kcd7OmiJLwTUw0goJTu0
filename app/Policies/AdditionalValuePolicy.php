<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdditionalValuePolicy
{
	use HandlesAuthorization;

	public function before($user, $ability)
	{
		if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
			return true;
		}
	}

	/**
	 * Determine whether the user can view the AdditionalValue.
	 *
	 * @param  App\User  $user
	 * @param  App\AdditionalValue  $additionalValue
	 * @return mixed
	 */
	public function view(User $user, AdditionalValue $additionalValue)
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
	 * Determine whether the user can update the AdditionalValue.
	 *
	 * @param  App\User  $user
	 * @param  App\AdditionalValue  $additionalValue
	 * @return mixed
	 */
	public function update(User $user, AdditionalValue $additionalValue)
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the AdditionalValue.
	 *
	 * @param  App\User  $user
	 * @param  App\AdditionalValue  $additionalValue
	 * @return mixed
	 */
	public function delete(User $user, AdditionalValue $additionalValue)
	{
		return false;
	}
}
