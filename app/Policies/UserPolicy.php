<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view_super_dashboard(User $user)
    {
      return $user->isSuperAdmin();
    }

    public function view_admin_dashboard(User $user)
    {
      return $user->isSuperAdmin() || $user->isAdmin();
    }
}
