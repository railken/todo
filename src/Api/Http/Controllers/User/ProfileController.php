<?php

namespace Api\Http\Controllers\User;

use Api\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Core\User\UserManager;
use Core\User\UserSerializer;

class ProfileController extends Controller
{

	/**
	 * Construct
	 *
	 * @param UserSerializer $serializer
	 */
	public function __construct(UserSerializer $serializer)
	{
		$this->serializer = $serializer;
	}

	/**
	 * Display current user
	 *
	 * @param Request $request
	 *
	 * @return response
	 */
	public function index(Request $request)
	{

		$data = $this->serializer->user(\Auth::user());
		
		return $this->success(['data' => $data]);
	}

}
