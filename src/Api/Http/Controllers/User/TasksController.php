<?php

namespace Api\Http\Controllers\User;

use Api\Http\Controllers\RestController as Controller;
use Railken\Laravel\Manager\ModelContract;

use Core\Task\TaskSerializer;
use Core\Task\TaskManager;
use Core\Task\Task;

use Illuminate\Http\Request;

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

    /**
     * Make a task 'done'
     *
     * @param integer $id
     * @param Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function done($id, Request $request)
    {
        $entity = $this->manager->find($id);


        if (empty($entity)) {
            abort(404);
        }

        if ($this->getUser() && $this->getUser()->id != $entity->user->id) {
            abort(501);
        }

        $entity = $this->manager->done($entity);

        return $this->success([
            'message' => 'ok',
            'data' => [
                'resources' => $this->serialize($entity)
            ]
        ]);
    }

    /**
     * Make a task 'undone'
     *
     * @param integer $id
     * @param Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function undone($id, Request $request)
    {
        $entity = $this->manager->find($id);


        if (empty($entity)) {
            abort(404);
        }

        if ($this->getUser() && $this->getUser()->id != $entity->user->id) {
            abort(501);
        }

        $entity = $this->manager->undone($entity);
        
        return $this->success([
            'message' => 'ok',
            'data' => [
                'resources' => $this->serialize($entity)
            ]
        ]);
    }
}
