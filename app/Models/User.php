<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Wallo\FilamentCompanies\HasCompanies;
use Wallo\FilamentCompanies\HasProfilePhoto;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens,
        HasFactory,
        HasProfilePhoto,
        HasCompanies,
        Notifiable,
        HasRoles,
        TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Define the hardware relationship.
     *
     * @return HasMany
     */
    public function hardware(): HasMany
    {
        return $this->hasMany(Hardware::class);
    }

    /**
     * Check if the user has a specific company permission.
     *
     * @param  string  $permission
     * @return bool
     */
    public function hasSelectCompanyPermission(string $permission): bool
    {
        $company = $this->currentCompany();

        return $this->hasCompanyPermission($company, $permission);
    }

    /**
     * Check if the user has the specified company model.
     *
    /**
     * Check if the user has the specified company model.
     *
     * @param Model $model
     * @return bool
     */
    public function hasCompanyModel(Model $model): bool
    {
        return $this->current_company_id === $model->company_id;
    }

    /**
     * Check if the user is a super admin.
     *
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super_admin');
    }

    /**
     * Check if the user can impersonate.
     *
     * @return bool
     */
    public function canImpersonate(): bool
    {
        return $this->isSuperAdmin();
    }

    /**
     * Check if the user can be impersonated.
     *
     * @return bool
     */
    public function canBeImpersonated(): bool
    {
        return ! $this->isSuperAdmin();
    }
}
