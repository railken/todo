<?php

namespace Api\Http\Controllers\User;

use Api\Http\Controllers\RestController as Controller;
use Railken\Laravel\Manager\ModelContract;

use Core\Task\TaskSerializer;
use Core\Task\TaskManager;
use Core\Task\Task;

class TasksController extends Controller
{

    /**
     * Construct
     *
     * @param TaskManager $manager
     */
    public function __construct(TaskManager $manager, TaskSerializer $serializer)
    {
        $this->manager = $manager;
        $this->serializer = $serializer;
    }

    /**
     * Return an array rappresentation of entity
     *
     * @param Railken\Laravel\Manager\ModelContract $entity
     *
     * @return array
     */
    public function serialize(ModelContract $entity)
    {
        return $this->serializer->all($entity);
    }
}
