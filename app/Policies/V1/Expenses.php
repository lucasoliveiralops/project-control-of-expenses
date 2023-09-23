<?php

namespace App\Policies\V1;

use App\Models\Expenses as Model;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class Expenses
{
    public function view(User $user, Model $expenses): Response
    {
        return $user->id === $expenses->user_id
        ? Response::allow()
        : Response::deny('You do not own this expense.');
    }


    public function update(User $user, Model $expenses): Response
    {
        return $user->id === $expenses->user_id
            ? Response::allow()
            : Response::deny('You do not own this expense.');
    }

    public function delete(User $user, Model $expenses): Response
    {
        return $user->id === $expenses->user_id
        ? Response::allow()
        : Response::deny('You do not own this expense.');
    }
}
