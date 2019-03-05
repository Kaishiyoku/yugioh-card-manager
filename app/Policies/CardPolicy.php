<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Card;
use Illuminate\Auth\Access\HandlesAuthorization;

class CardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the card.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Card  $card
     * @return mixed
     */
    public function view(User $user, Card $card)
    {
        //
    }

    /**
     * Determine whether the user can create cards.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the card.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Card  $card
     * @return mixed
     */
    public function update(User $user, Card $card)
    {
        return $user->id == $card->user->id;
    }

    /**
     * Determine whether the user can delete the card.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Card  $card
     * @return mixed
     */
    public function delete(User $user, Card $card)
    {
        return $user->id == $card->user->id;
    }

    /**
     * Determine whether the user can restore the card.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Card  $card
     * @return mixed
     */
    public function restore(User $user, Card $card)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the card.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Card  $card
     * @return mixed
     */
    public function forceDelete(User $user, Card $card)
    {
        //
    }
}
