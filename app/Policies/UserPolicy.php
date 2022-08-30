<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewBackend(User $user)
    {
        return ($user->role == 'admin' || $user->role == 'karyawan'
            ? Response::allow()
            : Response::deny('Anda bukan admin atau karyawan')
        );
    }

    public function viewFrontend(User $user)
    {
        return ($user->role == 'member'
            ? Response::allow()
            : Response::deny('Anda harus mendaftar member dulu')
        );
    }
}
