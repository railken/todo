<?php

namespace Core\Task;

use Railken\Laravel\Manager\ModelContract;
use Railken\Laravel\Manager\ModelManager;

use Core\Task\Task;

use Core\User\UserManager;
use Core\Project\ProjectManager;

class TaskManager extends ModelManager
{

    /**
     * Construct
     */
    public function __construct()
    {
        $this->repository = new TaskRepository();
        parent::__construct();
    }

    /**
     * Fill the entity
     *
     * @param ModelContract $entity
     * @param array $params
     *
     * @return ModelContract
     */
    public function fill(ModelContract $entity, array $params)
    {
        $params = $this->getOnlyParams($params, ['title', 'priority', 'expires_at', 'user_id', 'user', 'project_id', 'project']);

        if (isset($params['user']) || isset($params['user_id'])) {
            $this->vars['user'] = $this->fillManyToOneById($entity, new UserManager(), $params, 'user');
        }

           if (isset($params['project']) || isset($params['project_id'])) {
            $this->vars['project'] = $this->fillManyToOneById($entity, new ProjectManager(), $params, 'project');
        }

        $entity->fill($params);

        return $entity;
    }

    /**
     * This will prevent from saving entity with null value
     *
     * @param ModelContract $entity
     *
     * @return ModelContract
     */
    public function save(ModelContract $entity)
    {

        $entity->user()->associate($this->vars->get('user', $entity->user));
        $entity->project()->associate($this->vars->get('project', $entity->project));

        $this->throwExceptionParamsNull([
            'title' => $entity->title,
            'user' => $entity->user,
            'project' => $entity->project
        ]);

        return parent::save($entity);
    }

    /**
     * To array
     *
     * @param Core\Manager\ModelContract $entity
     *
     * @return array
     */
    public function toArray(ModelContract $entity)
    {
        return [];
    }
}
