<?php

namespace App\Policies;

use App\Models\Box;
use App\Models\User;

class BoxPolicy
{
    /**
     * Solo ADMIN puede crear, editar, eliminar cajas.
     */
    public function viewAny(User $user): bool
    {
        return true; // Todos los autenticados pueden ver la lista
    }

    public function view(User $user, Box $box): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Box $box): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Box $box): bool
    {
        return $user->isAdmin();
    }
}
