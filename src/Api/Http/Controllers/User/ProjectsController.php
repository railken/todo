<?php

namespace Api\Http\Controllers\User;

use Api\Http\Controllers\RestController as Controller;
use Railken\Laravel\Manager\ModelContract;

use Core\Project\ProjectSerializer;
use Core\Project\ProjectManager;
use Core\Project\Project;


class ProjectsController extends Controller
{

	/**
	 * Construct
	 *
	 * @param ProjectManager $manager
	 */
	public function __construct(ProjectManager $manager, ProjectSerializer $serializer)
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
