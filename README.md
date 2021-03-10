# Task Runner

[![tests](https://github.com/JustSteveKing/task-runner/actions/workflows/tests.yml/badge.svg)](https://github.com/JustSteveKing/task-runner/actions/workflows/tests.yml)

A simple task runner for PHP 8.


## Installation

```bash
$ composer require juststeveking/task-runner
```

## Usage

```php
$runner = Runner::prepare([]);

$task = new AddOne();

$runner->add($task);
$runner->run();
```