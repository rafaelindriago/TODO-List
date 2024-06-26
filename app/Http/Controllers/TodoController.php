<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Http\Resources\TodoResourceCollection;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Creates a new controller.
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->authorizeResource(Todo::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::query()
            ->latest()
            ->whereBelongsTo(Auth::user())
            ->paginate(10);

        return TodoResourceCollection::make($todos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        $todo = Todo::make();

        $todo->fill($request->only([
            'title',
            'description',
        ]))
            ->user()
            ->associate(Auth::user());

        $todo->save();

        return TodoResource::make($todo);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return TodoResource::make($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $todo->fill($request->only([
            'title',
            'description',
        ]))
            ->save();

        return TodoResource::make($todo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return TodoResource::make($todo);
    }
}
