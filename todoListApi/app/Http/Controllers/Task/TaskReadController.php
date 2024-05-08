<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskReadController extends Controller
{
    protected TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index(Request $request): JsonResponse
    {
        $tasks = $this->taskRepository->findAllTasks($request->all());

        return response()->json($tasks);
    }

    public function show(Request $request): JsonResponse
    {
        $task = $this->taskRepository->findTask($request->route('taskId'));

        return response()->json($task);
    }
}
