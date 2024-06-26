<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Tests\TestCase;

class DeleteTodoTest extends TestCase
{
    /**
     * Test if a todo can be deleted from database.
     */
    public function test_delete_a_todo(): void
    {
        $todo = Todo::factory()
            ->for(User::factory())
            ->create();

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
        ]);

        $todo->delete();

        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id,
        ]);
    }
}
