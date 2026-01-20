<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Peripheral;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PeripheralPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Peripheral $peripheral
     * @return bool
     */
    public function view(User $user, Peripheral $peripheral): bool
    {
        return
            $user->can('view_peripheral') ||
            $user->hasComapanyModel($peripheral);
    }

    /**
     * Determine whether the user can create models.
     *
     * @return bool
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @return Response|bool
     */
    public function update(User $user, Peripheral $peripheral): Response|bool
    {
        return
            $user->can('update_peripheral') ||
            $user->hasComapanyModel($peripheral);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Peripheral $peripheral
     * @return Response|bool
     */
    public function delete(User $user, Peripheral $peripheral): Response|bool
    {
        return
            $user->can('delete_peripheral') ||
            $user->hasComapanyModel($peripheral);
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return
            $user->can('delete_any_peripheral') ||
            $user->ownedCompanies();
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @return bool
     */
    public function forceDelete(User $user, Peripheral $peripheral): bool
    {
        return
            $user->can('force_delete_peripheral') ||
            $user->ownedCompanies();;
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param User $user
     * @return Response|bool
     */
    public function forceDeleteAny(User $user): Response|bool
    {
        return $user->can('force_delete_any_peripheral');
    }

    /**
     * Determine whether the user can restore.
     *
     * @return Response|bool
     */
    public function restore(User $user, Peripheral $peripheral): Response|bool
    {
        return
            $user->can('restore_peripheral') ||
            $user->ownedCompanies();
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @return Response|bool
     */
    public function restoreAny(User $user): Response|bool
    {
        return
            $user->can('restore_any_peripheral') ||
            $user->ownedCompanies();
    }

    /**
     * Determine whether the user can replicate.
     *
     * @return Response|bool
     */
    public function replicate(User $user, Peripheral $peripheral): Response|bool
    {
        return $user->can('replicate_peripheral');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @return Response|bool
     */
    public function reorder(User $user): Response|bool
    {
        return $user->can('reorder_peripheral');
    }
}
