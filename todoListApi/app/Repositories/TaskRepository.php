<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TaskRepository
{
    public function  findAllTasks(array $filters)
    {
        return Task::when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
        ->when($filters['priority'] ?? null, fn ($query, $priority) => $query->where('priority', $priority))
        ->when($filters['search'] ?? null, fn ($query, $search) => $query->where(function ($query) use ($search) {
            $query->where('title', 'LIKE', "%$search%")
                ->orWhere('description', 'LIKE', "%$search%");
        }))
        ->orderBy($filters['sortBy'] ?? 'created_at', $filters['sortDir'] ?? 'asc')
        ->orderBy('priority', 'desc')
        ->get();
    }


    public function findTask(int $taskId): Builder|array|Collection|Model
    {
        return Task::with('children')->find($taskId);
    }
}
