<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Company;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
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
     * @param Company $company
     * @return Response|bool
     */
    public function view(User $user, Company $company): Response|bool
    {
        return $user->belongsToCompany($company);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can add company employees.
     */
    public function addCompanyEmployee(User $user, Company $company): bool
    {
        return $user->ownsCompany($company);
    }

    /**
     * Determine whether the user can update company employee permissions.
     */
    public function updateCompanyEmployee(User $user, Company $company): bool
    {
        return $user->ownsCompany($company);
    }

    /**
     * Determine whether the user can remove company employees.
     */
    public function removeCompanyEmployee(User $user, Company $company): bool
    {
        return $user->ownsCompany($company);
    }


    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Company $company
     * @return Response|bool
     */
    public function update(User $user, Company $company): Response|bool
    {
        return $user->ownsCompany($company) || $user->can('update_company');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Company $company
     * @return Response|bool
     */
    public function delete(User $user, Company $company): Response|bool
    {
        return $user->ownsCompany($company) || $user->can('delete_company');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param User $user
     * @return Response|bool
     */
    public function deleteAny(User $user): Response|bool
    {
        return $user->can('delete_any_company');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param User $user
     * @param Company $company
     * @return Response|bool
     */
    public function forceDelete(User $user, Company $company): Response|bool
    {
        return $user->can('force_delete_company');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param User $user
     * @return Response|bool
     */
    public function forceDeleteAny(User $user): Response|bool
    {
        return $user->can('force_delete_any_company');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param User $user
     * @param Company $company
     * @return Response|bool
     */
    public function restore(User $user, Company $company): Response|bool
    {
        return $user->can('restore_company');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param User $user
     * @return Response|bool
     */
    public function restoreAny(User $user): Response|bool
    {
        return $user->can('restore_any_company');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param User $user
     * @param Company $company
     * @return Response|bool
     */
    public function replicate(User $user, Company $company): Response|bool
    {
        return $user->can('replicate_company');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param User $user
     * @return Response|bool
     */
    public function reorder(User $user): Response|bool
    {
        return $user->can('reorder_company');
    }
}
