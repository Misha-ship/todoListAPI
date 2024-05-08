<?php

namespace App\Http\Controllers\Task;

use App\DTO\TaskDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TaskWriteController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function store(TaskRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $taskDTO = new TaskDTO(
            $validatedData['title'],
            $validatedData['description'] ?? null,
            $validatedData['parent_id'] ?? null,
             $validatedData['priority'] ?? 3,
            $validatedData['status'] ?? TaskDTO::STATUS_TODO
        );


        $task = $this->taskService->create($taskDTO, $validatedData['user_id']);

        return response()->json($task, ResponseAlias::HTTP_CREATED);
    }

    public function update(TaskRequest $request, Task $task): JsonResponse
    {
        $validatedData = $request->validated();
        $taskDTO = new TaskDTO(
            $validatedData['title'],
            $validatedData['description'] ?? null,
            $validatedData['parent_id'] ?? null,
            $validatedData['priority'] ?? 3,
            $validatedData['status'] ?? TaskDTO::STATUS_TODO
        );

        $task = $this->taskService->update($task, $taskDTO, $validatedData['user_id']);

        return response()->json($task);
    }

    public function destroy(Task $task): Response
    {

        $this->taskService->delete($task);

        return response()->noContent();
    }

    public function markAsComplete(Request $request, Task $task): JsonResponse
    {
        try {
            $userId = $request->input('user_id');
            $completedTask = $this->taskService->markAsComplete($task, $userId);
            return response()->json($completedTask);
        } catch (HttpException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getStatusCode());
        }
    }
}
