<?php

declare(strict_types=1);

namespace JustSteveKing\TaskRunner\Contracts;

interface TasksContract
{
    public function handle(array $payload): array;
}
