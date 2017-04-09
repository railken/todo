<?php

namespace Api\Http\Controllers\Admin;

use Api\Http\Controllers\Controller;
use Api\Helper\Paginator;
use Core\User\UserSerializer;
use Core\User\UserManager;
use Core\User\User;

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
	 * Return a new instance of Manager
	 *
	 * @return UserManager
	 */
	public function getManager()
	{
		return $this->manager;
	}

	/**
	 * Return an array rappresentation of entity
	 *
	 * @param CoreBundle\Entity\User $user
	 *
	 * @return array
	 */
	public function serialize(User $user)
	{
		return $this->serializer->basic($user);
	}

	/**
	 * Return a json response of view list
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{

		$manager = $this->getManager();

		$query = $manager->getRepository()->getQuery();

		$searches = $request->input('search', []);

		$query->where(function($qb) use($searches) {
			foreach ($searches as $name => $search) {
				$qb->orWhere($name, $search);
			}
		});

		$paginator = Paginator::retrieve($query, $request->input('page', 1), $request->input('show', 10));

		$sort = [
			'field' => strtolower($request->input('sort_field', 'id')),
			'direction' => strtolower($request->input('sort_direction', 'desc')),
		];

		$results = $query
			->orderBy($sort['field'], $sort['direction'])
			->skip($paginator->getFirstResult())
			->take($paginator->getMaxResults())
			->get();


		foreach ($results as $n => $k) {
			$results[$n] = $this->serialize($k);
		}

		return $this->success([
			'message' => 'ok',
			'data' => [
				'resources' => $results,
				'pagination' => $paginator,
				'sort' => $sort,
				'search' => $searches,
			]
		]);

	}

	/**
	 * Return a json response to insert
	 *
	 * @param Request $request
	 *
	 * @return Response
 	 */
	public function create(Request $request)
	{

		$manager = $this->getManager();

		$user = $manager->create($request->all());

		return $this->success([
			'message' => 'ok',
			'data' => [
				'resource' => $this->serialize($user)
			]
		]);

	}


	/**
	 * Return a json response to get
	 *
	 * @param Request $request
	 *
	 * @return Response
	*/
	public function show($id, Request $request)
	{

		$manager = $this->getManager();

		$user = $manager->find($id);

		if (empty($user))
			abort(404);

		return $this->success([
			'message' => 'ok',
			'data' => [
				'resource' => $this->serialize($user)
			]
		]);


	}
	/**
	 * Return a json response to insert
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$manager = $this->getManager();

		$user = $manager->find($id);

		if (empty($user))
			abort(404);

		$manager->update($user, $request->all());

		return $this->success([
			'message' => 'ok',
			'data' => [
				'resource' => $this->serialize($user)
			]
		]);

	}

	/**
	* Return a json response to insert
	*
	* @Route("/{ids}")
	* @Method("DELETE")
	*
	* @param Request $request
	*
	* @return Response
	*/
	public function delete($ids, Request $request)
	{

		$manager = $this->getManager();

		$users = $manager->findWhereIn(['id' => explode(";",$ids)]);

		if ($users->count() == 0)
			abort(404);

		$manager->deleteMultiple($users);

		return $this->success([
			'message' => 'ok'
		]);

	}

}
