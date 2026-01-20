<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Hardware;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class HardwarePolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     *
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
     * @param Hardware $hardware
     * @return Response|bool
     */
    public function view(User $user, Hardware $hardware): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @return Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @return Response|bool
     */
    public function update(User $user, Hardware $hardware)
    {
        return
            $user->can('update_hardware') ||
            $user->hasCompanyModel($hardware);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @return Response|bool
     */
    public function delete(User $user, Hardware $hardware)
    {
        return $user->can('delete_hardware') ||
            $user->hasCompanyModel($hardware);
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @return Response|bool
     */
    public function deleteAny(User $user)
    {
        return
            $user->can('delete_any_hardware') ||
            $user->ownedCompanies();
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @return Response|bool
     */
    public function forceDelete(User $user, Hardware $hardware)
    {
        return
            $user->can('force_delete_hardware') ||
            $user->ownedCompanies();
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @return Response|bool
     */
    public function forceDeleteAny(User $user)
    {
        return $user->can('force_delete_any_hardware');
    }

    /**
     * Determine whether the user can restore.
     *
     * @return Response|bool
     */
    public function restore(User $user, Hardware $hardware)
    {
        return
            $user->can('restore_hardware') ||
            $user->ownedCompanies();
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @return Response|bool
     */
    public function restoreAny(User $user)
    {
        return
            $user->can('restore_any_hardware') ||
            $user->ownedCompanies();
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param User $user
     * @param Hardware $hardware
     * @return Response|bool
     */
    public function replicate(User $user, Hardware $hardware): Response|bool
    {
        return $user->can('replicate_hardware');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param User $user
     * @return Response|bool
     */
    public function reorder(User $user): Response|bool
    {
        return $user->can('reorder_hardware');
    }
}
