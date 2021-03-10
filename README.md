# Task Runner

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