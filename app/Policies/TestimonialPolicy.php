<?php

namespace App\Policies;

use App\User;
use App\Testimonial;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestimonialPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->type == 1 && $user->hasRoles(['Administrator', 'SuperModerator'])) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the testimonial.
     *
     * @param  App\User  $user
     * @param  App\Testimonial  $testimonial
     * @return mixed
     */
    public function view(User $user, Testimonial $testimonial)
    {
        return $user->hasRoles('Moderator');
    }

    /**
     * Determine whether the user can create testimonials.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRoles('Moderator');
    }

    /**
     * Determine whether the user can update the testimonial.
     *
     * @param  App\User  $user
     * @param  App\Testimonial  $testimonial
     * @return mixed
     */
    public function update(User $user, Testimonial $testimonial)
    {
        return $user->hasRoles('Moderator');
    }

    /**
     * Determine whether the user can delete the testimonial.
     *
     * @param  App\User  $user
     * @param  App\Testimonial  $testimonial
     * @return mixed
     */
    public function delete(User $user, Testimonial $testimonial)
    {
        return $user->hasRoles('Moderator');
    }
}
