<?php

namespace App\Policies;

use App\Models\Set;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the set.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Set  $set
     * @return mixed
     */
    public function view(User $user, Set $set)
    {
        //
    }

    /**
     * Determine whether the user can create sets.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the set.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Set  $set
     * @return mixed
     */
    public function update(User $user, Set $set)
    {
        return $user->id == $set->user->id;
    }

    /**
     * Determine whether the user can delete the set.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Set  $set
     * @return mixed
     */
    public function delete(User $user, Set $set)
    {
        //
    }

    /**
     * Determine whether the user can restore the set.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Set  $set
     * @return mixed
     */
    public function restore(User $user, Set $set)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the set.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Set  $set
     * @return mixed
     */
    public function forceDelete(User $user, Set $set)
    {
        //
    }
}
