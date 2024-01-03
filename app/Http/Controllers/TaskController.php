<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Activity;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // create a new task
    public function create(TaskRequest $request, Activity $activity, User $user)
    {
        $task = Task::create($request->all());
        $task->activity()->associate($activity);
        $task->user()->associate($user);
        $task->save();
        return TaskResource::make($task);

    }

    // get all tasks
    public function index()
    {
        // get all tasks
        $tasks = Task::all();

        // return the tasks
        return TaskResource::collection($tasks);
    }

    // get a single task
    public function show(Task $task)
    {
        // return the task
        return TaskResource::make($task);
    }

    // update a task
    public function update(Task $task, TaskRequest $request)
    {
        $task->update($request->all());

        return TaskResource::make($task);
    }

    // delete a task
    public function delete(Task $task)
    {
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully'], 200);
    }

    // create a new task with auth
    public function createAuth(TaskRequest $request, Activity $activity)
    {
        $user = Auth::user();
        $task = $user->tasks()->create([
            'activity_id' => $activity->id,
            'quantity' => $request->quantity,
            'duration' => $request->duration,
        ]);
        return TaskResource::make($task);
    }

    // get all tasks with auth
    public function indexAuth()
    {
        $user = Auth::user();
        return TaskResource::collection($user->tasks);
    }

    // update a task with auth
    public function updateAuth(TaskRequest $request, Task $task)
    {
        $task->update($request->all(['activity_id', 'quantity', 'duration']));
        return TaskResource::make($task);
    }

    // delete a task with auth
    public function deleteAuth(Task $task)
    {
        $user = Auth::user();
        $task = $user->tasks()->findOrFail($task->id);
        $task->delete();
        return TaskResource::make($task);
    }

}
