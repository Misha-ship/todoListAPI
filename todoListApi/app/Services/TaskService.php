<?php

namespace app\Services;

use App\DTO\TaskDTO;
use App\Models\Task;

class TaskService
{
    public function create(TaskDTO $taskDTO, int $userId): Task
    {
        $data = [
            'user_id' => $userId,
            'title' => $taskDTO->title,
            'description' => $taskDTO->description,
            'parent_id' => $taskDTO->parent_id,
            'priority' => $taskDTO->priority,
            'status' => $taskDTO->status,
        ];

        return Task::create($data);
    }

    public function update(Task $task, TaskDTO $taskDTO, int $userId): Task
    {
        if ($task->user_id !== $userId) {
            abort(403, 'You do not have permission to update this task.');
        }

        $task->update([
            'title' => $taskDTO->title,
            'description' => $taskDTO->description,
            'priority' => $taskDTO->priority,
            'status' => $taskDTO->status,
        ]);

        return $task;
    }

    public function delete(Task $task,  int $userId): void
    {
        if ($task->user_id !== $userId) {
            abort(403, 'You do not have permission to remove this task.');
        }

        $task->delete();
    }

    public function markAsComplete(Task $task, int $userId): Task
    {
        if ($task->user_id !== $userId) {
            abort(403, 'You do not have permission to complete this task.');
        }

        if ($task->status === 'todo' && $task->children()->where('status', Task::TODO)->exists()) {
            abort(400, 'Complete all subtasks first.');
        }

        $task->update([
            'status' => $task->status === Task::TODO ? Task::DONE : Task::TODO,
            'completed_at' => $task->status === Task::TODO ? now() : null
        ]);

        return $task;
    }
}
