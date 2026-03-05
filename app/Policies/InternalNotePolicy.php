<?php

namespace App\Policies;

use App\Models\InternalNote;
use App\Models\User;

class InternalNotePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, InternalNote $note): bool
    {
        if ($user->isAdmin()) {
            return true;
        }
        return $note->created_by === $user->id;
    }

    public function create(User $user): bool
    {
        return true; // Ambos roles pueden crear
    }

    public function update(User $user, InternalNote $note): bool
    {
        return $note->canBeEditedBy($user);
    }

    public function delete(User $user, InternalNote $note): bool
    {
        return $note->canBeDeletedBy($user);
    }

    /**
     * Solo ADMIN puede verificar o rechazar
     */
    public function verify(User $user, InternalNote $note): bool
    {
        return $user->isAdmin() && $note->isEnviado();
    }

    /**
     * Solo el creador puede enviar (de BORRADOR a ENVIADO)
     */
    public function send(User $user, InternalNote $note): bool
    {
        if ($user->isAdmin()) {
            return $note->isBorrador();
        }
        return $note->created_by === $user->id && $note->isBorrador();
    }
}
