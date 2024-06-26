<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * Test if a new user can be registered into the app.
     */
    public function test_user_can_be_registered(): void
    {
        $fields = [
            'name' => fake()->firstName(),
            'email' => fake()->safeEmail(),
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post('/register', $fields);

        $response->assertRedirectToRoute('home');

        $this->assertDatabaseHas('users', [
            'email' => $fields['email'],
        ]);
    }
}
