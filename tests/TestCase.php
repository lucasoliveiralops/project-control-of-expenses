<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected User $userToken;

    const DEFAULT_HEADERS = [
        "Content-Type" => "application/json",
        "Accept" => "application/json"
    ];

    public function generateBarearToken(): string
    {
        $this->userToken = User::factory()->create();
        return $this->userToken->createToken('auth_token')->plainTextToken;
    }
}
