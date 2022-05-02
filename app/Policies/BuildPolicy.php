<?php

namespace App\Policies;

use App\Models\Build;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuildPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */

    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
    
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Build  $build
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Build $build)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Build  $build
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Build $build)
    {
        // return $user->id === $build->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Build  $build
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Build $build)
    {
        // return $user->id === $build->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Build  $build
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Build $build)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Build  $build
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Build $build)
    {
        //
    }
}
