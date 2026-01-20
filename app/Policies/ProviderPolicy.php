<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Provider;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProviderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Provider $provider
     * @return bool
     */
    public function view(User $user, Provider $provider): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Provider $provider
     * @return bool
     */
    public function update(User $user, Provider $provider): bool
    {
        return
            $user->can('update_provider');
            //$user->hasCompanyModel($provider);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Provider $provider
     * @return Response|bool
     */
    public function delete(User $user, Provider $provider): Response|bool
    {
        return
            $user->can('delete_provider');
            //$user->hasCompanyModel($provider);
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param User $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return
            $user->can('delete_any_provider') ||
            $user->ownedCompanies();
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param User $user
     * @param Provider $provider
     * @return bool
     */
    public function forceDelete(User $user, Provider $provider): bool
    {
        return $user->can('force_delete_provider');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param User $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_provider');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param User $user
     * @param Provider $provider
     * @return bool
     */
    public function restore(User $user, Provider $provider): bool
    {
        return $user->can('restore_provider');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param User $user
     * @return bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_provider');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param User $user
     * @param Provider $provider
     * @return bool
     */
    public function replicate(User $user, Provider $provider): bool
    {
        return $user->can('replicate_provider');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param User $user
     * @return bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_provider');
    }
}
