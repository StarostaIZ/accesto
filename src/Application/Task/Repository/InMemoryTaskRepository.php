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
        array_unshift($this->tasks, $task);
    }

    public function get(int $id): Task
    {
        foreach ($this->tasks as $task) {
            if ($task->getId()==$id){
                return $task;
            }
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
