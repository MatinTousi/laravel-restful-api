<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Post $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->role == 2;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Post $post): bool
    {
        return $admin->role == 2;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Post $post): bool
    {
        return $admin->role == 2 || $admin->role == 1;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, Post $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, Post $post): bool
    {
        return false;
    }
}
