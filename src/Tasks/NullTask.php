<?php

declare(strict_types=1);

namespace JustSteveKing\TaskRunner\Tasks;

use JustSteveKing\TaskRunner\Contracts\TasksContract;

abstract class NullTask implements TasksContract
{
    public function handle(array $payload): array
    {
        return $payload;
    }
}
