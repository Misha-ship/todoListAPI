<?php

namespace app\DTO;

use InvalidArgumentException;

class TaskDTO
{
    const STATUS_TODO = 'todo';
    const STATUS_DONE = 'done';

    public function __construct(
        public string $title,
        public ?string $description = null,
        public ?int $parent_id = null,
        public int $priority = 3,
        public string $status = self::STATUS_TODO
    ) {
        $this->setStatus($status);
    }

    public function setStatus(string $status): void
    {
        if (!in_array($status, [self::STATUS_TODO, self::STATUS_DONE])) {
            throw new InvalidArgumentException('Invalid status value');
        }

        $this->status = $status;
    }
}
