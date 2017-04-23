<?php

namespace Core\Project;

use Railken\Laravel\Manager\ModelRepository;

class ProjectRepository extends ModelRepository
{

    /**
     * Class name entity
     *
     * @var string
     */
    public $entity = Project::class;
}
