<?php

namespace App\Policies;

use App\User;
use App\Producer;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProducerPolicy
{
	use HandlesAuthorization;

	public function before($user, $ability)
	{
		if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
			return true;
		}
	}

	/**
	 * Determine whether the user can view the Producer.
	 *
	 * @param  App\User  $user
	 * @param  App\Producer  $producer
	 * @return mixed
	 */
	public function view(User $user, Producer $producer)
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
	 * Determine whether the user can update the Producer.
	 *
	 * @param  App\User  $user
	 * @param  App\Producer  $producer
	 * @return mixed
	 */
	public function update(User $user, Producer $producer)
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the Producer.
	 *
	 * @param  App\User  $user
	 * @param  App\Producer  $producer
	 * @return mixed
	 */
	public function delete(User $user, Producer $producer)
	{
		return false;
	}
}
