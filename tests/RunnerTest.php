<?php

declare(strict_types=1);

namespace JustSteveKing\TaskRunner\Tests;

use PHPUnit\Framework\TestCase;
use JustSteveKing\TaskRunner\Runner;
use JustSteveKing\TaskRunner\Tasks\NullTask;
use JustSteveKing\TaskRunner\Tests\Stubs\AddFive;
use JustSteveKing\TaskRunner\Tests\Stubs\AddTwo;

class RunnerTest extends TestCase
{
    protected function runner(
        array $tasks = [],
        array $payload = [],
    ): Runner {
        return Runner::prepare(
            tasks: $tasks,
            payload: $payload,
        );
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

        $runner->add(
            task: $task,
        );

        $this->assertNotEmpty(
            actual: $runner->tasks(),
        );

        $this->assertCount(
            expectedCount: 1,
            haystack: $runner->tasks(),
        );
    }

    /**
     * @test
     */
    public function it_can_handle_a_task()
    {
        $runner = $this->runner();

        $task = $this->getMockForAbstractClass(NullTask::class);

        $runner->add(
            task: $task,
        );

        $data = ['name' => 'PHPUnit'];

        $payload = $runner->run(
            payload: $data,
        );

        $this->assertNotEmpty(
            actual: $payload,
        );

        $this->assertEquals(
            expected: $data,
            actual: $payload,
        );
    }

    /**
     * @test
     */
    public function it_handles_the_before_method_on_a_task()
    {
        $runner = $this->runner();

        $runner->add(
            task: new AddTwo(), 
        );

        $this->assertNotEmpty(
            actual: $runner->tasks(),
        );

        $payload = $runner->run(
            payload: ['count' => 1],
        );

        $this->assertNotEmpty(
            actual: $payload,
        );

        $this->assertEquals(
            expected: 3,
            actual: $payload['count']
        );
    }

    /**
     * @test
     */
    public function it_handles_the_before_and_after_methods()
    {
        $runner = $this->runner();

        $runner->add(
            task: new AddFive(), 
        );

        $this->assertNotEmpty(
            actual: $runner->tasks(),
        );

        $payload = $runner->run(
            payload: ['count' => 1],
        );

        $this->assertNotEmpty(
            actual: $payload,
        );

        $this->assertEquals(
            expected: 6,
            actual: $payload['count']
        );
    }
}
