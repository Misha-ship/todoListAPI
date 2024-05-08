<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $parentTask = $this->faker->boolean(70) ? null : Task::inRandomOrder()->first();

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'priority' => $this->faker->numberBetween(1, 5),
            'status' => 'todo',
            'user_id' => $user->id,
            'parent_id' => $parentTask ? $parentTask->id : null,
            'completed_at' => null,
        ];
    }
}
