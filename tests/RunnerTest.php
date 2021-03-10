<?php

declare(strict_types=1);

namespace JustSteveKing\TaskRunner\Tests;

use PHPUnit\Framework\TestCase;
use JustSteveKing\TaskRunner\Runner;
use JustSteveKing\TaskRunner\Tasks\NullTask;

class RunnerTest extends TestCase
{
    protected function runner(array $tasks = []): Runner
    {
        return Runner::prepare($tasks);
    }

    /**
     * @test
     */
    public function it_will_build_a_runner()
    {
        $this->assertInstanceOf(
            expected: Runner::class,
            actual: $this->runner(),
        );
    }

    /**
     * @test
     */
    public function it_starts_a_runner_with_an_empty_array_for_tasks()
    {
        $runner = $this->runner();

        $this->assertIsArray(
            actual: $runner->tasks(),
        );

        $this->assertEmpty(
            actual: $runner->tasks(),
        );
    }

    /**
     * @test
     */
    public function it_can_add_a_new_task()
    {
        $runner = $this->runner();

        $task = $this->getMockForAbstractClass(NullTask::class);

        $runner->add($task);

        $this->assertNotEmpty(
            actual: $runner->tasks(),
        );

        $this->assertCount(
            expectedCount: 1,
            haystack: $runner->tasks(),
        );
    }
}
