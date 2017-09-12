<?php

namespace App\Policies;

use App\User;
use App\ProductCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductCategoryPolicy
{
	use HandlesAuthorization;

	public function before($user, $ability)
	{
		if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
			return true;
		}
	}

	/**
	 * Determine whether the user can view the ProductCategory.
	 *
	 * @param  App\User  $user
	 * @param  App\ProductCategory  $productcategory
	 * @return mixed
	 */
	public function view(User $user, ProductCategory $productcategory)
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
	 * Determine whether the user can update the ProductCategory.
	 *
	 * @param  App\User  $user
	 * @param  App\ProductCategory  $productcategory
	 * @return mixed
	 */
	public function update(User $user, ProductCategory $productcategory)
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the ProductCategory.
	 *
	 * @param  App\User  $user
	 * @param  App\ProductCategory  $productcategory
	 * @return mixed
	 */
	public function delete(User $user, ProductCategory $productcategory)
	{
		return false;
	}
}
