<?php

namespace Core\Task;

use Railken\Laravel\Manager\ModelRepository;

class TaskRepository extends ModelRepository
{

    /**
     * Class name entity
     *
     * @var string
     */
    public $entity = Task::class;
}
