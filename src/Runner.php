<?php

declare(strict_types=1);

namespace JustSteveKing\TaskRunner;

use JustSteveKing\TaskRunner\Contracts\TasksContract;

class Runner
{
    private function __construct(
        protected array $tasks,
        protected array $payload,
    ) {}

    public static function prepare(
        array $tasks = [],
        array $payload = [],
    ): Runner {
        return new Runner(
            tasks: $tasks,
            payload: $payload,
        );
    }

    public function tasks(): array
    {
        return $this->tasks;
    }

    public function add(TasksContract $task): self
    {
        $this->tasks[] = $task;

        return $this;
    }

    public function run(array $payload): array
    {
        foreach ($this->tasks() as $task) {
            if (method_exists($task, 'before')) {
                $payload = $task->before(
                    payload: $payload,
                );
            }

            $payload = $task->handle(
                payload: $payload,
            );

            if (method_exists($task, 'after')) {
                $payload = $task->after(
                    payload: $payload,
                );
            }
        }

        return $payload;
    }
}
