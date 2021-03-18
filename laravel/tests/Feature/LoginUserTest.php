<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginUserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testUser()
    {
        $user = User::factory()->count(2)->create();
    }
}
