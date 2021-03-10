<?php

declare(strict_types=1);

namespace JustSteveKing\TaskRunner\Tests\Stubs;

use JustSteveKing\TaskRunner\Contracts\TasksContract;

class AddFive implements TasksContract
{
    public function before(array $payload): array
    {
        $payload['count'] = ($payload['count'] + 4);

        return $payload;
    }

    public function handle(array $payload): array
    {
        $payload['count'] = ($payload['count'] + 2);

        return $payload;
    }

    public function after(array $payload): array
    {
        $payload['count'] = ($payload['count'] - 1);

        return $payload;
    }
}
