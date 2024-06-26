<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * Test if an user can login into the app.
     */
    public function test_user_can_login(): void
    {
        $user = User::factory()
            ->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirectToRoute('home');
    }
}
