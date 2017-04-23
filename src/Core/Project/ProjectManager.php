<?php

namespace Core\Project;

use Railken\Laravel\Manager\ModelContract;
use Railken\Laravel\Manager\ModelManager;

use Core\Project\Project;

use Core\User\UserManager;

class ProjectManager extends ModelManager
{

    /**
     * Construct
     */
    public function __construct()
    {
        $this->repository = new ProjectRepository();
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
        $params = $this->getOnlyParams($params, ['name', 'user', 'user_id']);

        if (isset($params['user']) || isset($params['user_id'])) {
            $this->vars['user'] = $this->fillManyToOneById($entity, new UserManager(), $params, 'user');
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

        $this->throwExceptionParamsNull([
            'name' => $entity->name,
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
