<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Tests\TestCase;

class TodoEndpointTest extends TestCase
{
    /**
     * Test if a todo can be stored in the app.
     */
    public function test_store_todo(): void
    {
        $user = User::factory()
            ->create();

        $this->actingAs($user);

        $fields = [
            'title' => fake()->text(128),
            'description' => fake()->text(2048),
        ];

        $response = $this->post('/todos', $fields);

        $response->assertStatus(201);
        $response->assertJsonFragment($fields);

        $this->assertDatabaseHas('todos', $fields);
    }

    /**
     * Test if a todo can be viewed in the app.
     */
    public function test_show_todo(): void
    {
        $user = User::factory()
            ->create();

        $this->actingAs($user);

        $todo = Todo::factory()
            ->for($user)
            ->create();

        $response = $this->get("/todos/{$todo->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $todo->id,
            'title' => $todo->title,
            'description' => $todo->description,
        ]);
    }

    /**
     * Test if a todo can be updated in the app.
     */
    public function test_update_todo(): void
    {
        $user = User::factory()
            ->create();

        $this->actingAs($user);

        $todo = Todo::factory()
            ->for($user)
            ->create();

        $fields = [
            'title' => fake()->text(128),
            'description' => fake()->text(2048),
        ];

        $response = $this->patch("/todos/{$todo->id}", $fields);

        $response->assertStatus(200);
        $response->assertJsonFragment($fields);

        $this->assertDatabaseHas('todos', $fields);
    }

    /**
     * Test if a todo can be destroyed in the app.
     */
    public function test_destroy_todo(): void
    {
        $user = User::factory()
            ->create();

        $this->actingAs($user);

        $todo = Todo::factory()
            ->for($user)
            ->create();

        $response = $this->delete("/todos/{$todo->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id,
        ]);
    }

    /**
     * Test if the app validates the input data for store a todo.
     */
    public function test_store_todo_validation(): void
    {
        $user = User::factory()
            ->create();

        $this->actingAs($user);

        $fields = [
            'title' => null,
            'description' => fake()->text(4096),
        ];

        $response = $this->post('/todos', $fields);

        $response->assertInvalid([
            'title',
            'description',
        ]);
    }

    /**
     * Test if the app validates the input data for update a todo.
     */
    public function test_update_todo_validation(): void
    {
        $user = User::factory()
            ->create();

        $this->actingAs($user);

        $todo = Todo::factory()
            ->for($user)
            ->create();

        $fields = [
            'title' => null,
            'description' => fake()->text(4096),
        ];

        $response = $this->patch("/todos/{$todo->id}", $fields);

        $response->assertInvalid([
            'title',
            'description',
        ]);
    }

    /**
     * Test if the app authorizes the user to view a todo.
     */
    public function test_view_todo_authorization(): void
    {
        $user = User::factory()
            ->create();

        $todo = Todo::factory()
            ->for($user)
            ->create();

        $otherUser = User::factory()
            ->create();

        $this->actingAs($otherUser);

        $response = $this->get("/todos/{$todo->id}");

        $response->assertStatus(403);
    }

    /**
     * Test if the app authorizes the user to update a todo.
     */
    public function test_update_todo_authorization(): void
    {
        $user = User::factory()
            ->create();

        $todo = Todo::factory()
            ->for($user)
            ->create();

        $otherUser = User::factory()
            ->create();

        $this->actingAs($otherUser);

        $fields = [
            'title' => fake()->text(128),
            'description' => fake()->text(2048),
        ];

        $response = $this->patch("/todos/{$todo->id}", $fields);

        $response->assertStatus(403);
    }

    /**
     * Test if the app authorizes the user to delete a todo.
     */
    public function test_delete_todo_authorization(): void
    {
        $user = User::factory()
            ->create();

        $todo = Todo::factory()
            ->for($user)
            ->create();

        $otherUser = User::factory()
            ->create();

        $this->actingAs($otherUser);

        $response = $this->delete("/todos/{$todo->id}");

        $response->assertStatus(403);
    }
}
