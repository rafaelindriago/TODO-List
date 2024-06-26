<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Tests\TestCase;

class SaveTodoTest extends TestCase
{
    /**
     * Test if a todo can be saved to create a new one in the database.
     */
    public function test_save_to_store_a_todo(): void
    {
        $todo = Todo::make()
            ->fill([
                'title' => fake()->text(128),
                'description' => fake()->text(2048),
            ])
            ->user()
            ->associate(User::factory()->create());

        $todo->save();

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
        ]);
    }

    /**
     * Test if a todo can be saved to update in the database.
     */
    public function test_save_to_update_a_todo(): void
    {
        $todo = Todo::factory()
            ->for(User::factory())
            ->create();

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
        ]);

        $fields = [
            'title' => fake()->text(128),
            'description' => fake()->text(2048),
        ];

        $todo->fill($fields)
            ->save();

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'title' => $todo->title,
        ]);
    }
}
