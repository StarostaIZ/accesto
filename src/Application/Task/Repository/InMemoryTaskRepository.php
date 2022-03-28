<?php

declare(strict_types=1);

namespace App\Application\Task\Repository;

use App\Application\Task\Exception\TaskNotFoundException;
use App\Domain\Task\Task;

class InMemoryTaskRepository implements TaskRepository
{
    /** @var Task[]  */
    private array $tasks = [];

    public function save(Task $task): void
    {
        $this->tasks[$task->getId()] = $task;
    }

    public function get(int $id): Task
    {
        if (array_key_exists($id, $this->tasks)) {
            return $this->tasks[$id];
        }
        throw new TaskNotFoundException($id);
    }

    public function findCurrent(): array
    {
        return array_values(array_filter($this->tasks, fn($task) => !$task->isDone()));
    }

    public function findDone(): array
    {
        return array_values(array_filter($this->tasks, fn($task) => $task->isDone()));
    }
}
