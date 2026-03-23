<?php

namespace App\Policies;

use App\Models\Rate;
use App\Models\User;

class RatePolicy
{
    // Tout le monde peut voir les notes
    public function viewAny(User $user): bool
    {
        return true;
    }

    // Tout le monde peut voir une note
    public function view(User $user, Rate $rate): bool
    {
        return true;
    }

    // Un utilisateur connecté peut créer une note
    public function create(User $user): bool
    {
        return true;
    }

    // Seul le propriétaire peut modifier sa note
    public function update(User $user, Rate $rate): bool
    {
        return $user->id === $rate->user_id;
    }

    // Le propriétaire OU l'admin peut supprimer
    public function delete(User $user, Rate $rate): bool
    {
        return $user->id === $rate->user_id || $user->isAdmin();
    }

    public function restore(User $user, Rate $rate): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Rate $rate): bool
    {
        return $user->isAdmin();
    }
}