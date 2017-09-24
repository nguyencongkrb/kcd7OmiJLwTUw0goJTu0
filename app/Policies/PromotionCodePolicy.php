<?php

namespace App\Policies;

use App\User;
use App\PromotionCode;
use Illuminate\Auth\Access\HandlesAuthorization;

class PromotionCodePolicy
{
	use HandlesAuthorization;

	public function before($user, $ability)
	{
		if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
			return true;
		}
	}

	/**
	 * Determine whether the user can view the promotionCode.
	 *
	 * @param  \App\User  $user
	 * @param  \App\PromotionCode  $promotionCode
	 * @return mixed
	 */
	public function view(User $user, PromotionCode $promotionCode)
	{
		return $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can create promotionCodes.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can update the promotionCode.
	 *
	 * @param  \App\User  $user
	 * @param  \App\PromotionCode  $promotionCode
	 * @return mixed
	 */
	public function update(User $user, PromotionCode $promotionCode)
	{
		return !$promotionCode->used && $user->hasRoles('Moderator');
	}

	/**
	 * Determine whether the user can delete the promotionCode.
	 *
	 * @param  \App\User  $user
	 * @param  \App\PromotionCode  $promotionCode
	 * @return mixed
	 */
	public function delete(User $user, PromotionCode $promotionCode)
	{
		return !$promotionCode->used && $user->hasRoles('Moderator');
	}
}
