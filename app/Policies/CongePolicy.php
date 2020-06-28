<?php

namespace App\Policies;

use App\Conge;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CongePolicy
{
    use HandlesAuthorization;

    public function before($user ,$ability)
    {
if($user->is_admin)
{
    return false;
}
    }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Conge  $conge
     * @return mixed
     */
    public function view(User $user, Conge $conge)
    {
        return true;
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Conge  $conge
     * @return mixed
     */
    public function update(User $user, Conge $conge)
    {
        //
        return (($user->id===$conge->user_id)&&($conge->etat===5));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Conge  $conge
     * @return mixed
     */
    public function delete(User $user, Conge $conge)
    {
        //
        return $user->id===$conge->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Conge  $conge
     * @return mixed
     */
    public function restore(User $user, Conge $conge)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Conge  $conge
     * @return mixed
     */
    public function forceDelete(User $user, Conge $conge)
    {
        //
    }
}
