<?php

declare(strict_types=1);

namespace JustSteveKing\TaskRunner\Tests\Stubs;

use JustSteveKing\TaskRunner\Contracts\TasksContract;

class AddTwo implements TasksContract
{
    public function before(array $payload): array
    {
        $payload['count'] = ($payload['count'] + 1);

        return $payload;
    }

    public function handle(array $payload): array
    {
        $payload['count'] = ($payload['count'] + 1);

        return $payload;
    }
}
