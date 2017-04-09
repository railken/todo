<?php

namespace Api\Http\Controllers\Admin;

use Api\Helper\Paginator;
use Core\User\UserSerializer;
use Core\User\UserManager;
use Core\User\User;
use Railken\Laravel\Manager\ModelContract;

use Illuminate\Http\Request;


class UsersController extends Controller
{

	/**
	 * Construct
	 *
	 * @param UserManager $manager
	 */
	public function __construct(UserManager $manager, UserSerializer $serializer)
	{
		$this->manager = $manager;
		$this->serializer = $serializer;
	}

	/**
	 * Return an array rappresentation of entity
	 *
	 * @param Railken\Laravel\Manager\ModelContract $user
	 *
	 * @return array
	 */
	public function serialize(ModelContract $user)
	{
		return $this->serializer->user($user);
	}

}
