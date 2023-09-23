<?php

namespace App\Services\V1\Account;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Login
{
    private null|User $user;

    public function login(string $userMail, string $password): bool
    {
        $this->user = User::where('email', $userMail)->first();
        if (Hash::check($password, $this->user?->password)) {
            return true;
        }
        return false;
    }

    public function generateToken(): string|null
    {
        if (empty($this->user)) {
            return null;
        }
        return $this->user->createToken('auth_token')->plainTextToken;
    }
}
