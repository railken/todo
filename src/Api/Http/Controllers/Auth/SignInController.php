<?php

namespace Api\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Api\Http\Controllers\Controller;
use Core\User\UserManager;
use Core\User\UserSerializer;
use Api\Api\Manager as ApiManager;
use Api\OAuth\GithubProvider;
use Api\OAuth\Entity\AccessToken;

class SignInController extends Controller
{


	/**
	 * List of all providers
	 *
	 * @var array
	 */
	protected $providers = [
		'github' => GithubProvider::class,
	];

	/**
	 * Get provider
	 *
	 * @return Provider
	 */
	public function getProvider($name)
	{
		$class = isset($this->providers[$name]) ? $this->providers[$name] : null;

		if (!$class)
			return null;

		return new $class;

	}
	/**
	 * Construct
	 *
	 * @param UserSerializer $user
	 */
	public function __construct(UserManager $manager, UserSerializer $serializer)
	{
		$this->serializer = $serializer;
		$this->manager = $manager;
	}

	/**
	 * Sign in a user
	 *
	 * @param string $provider
	 * @param Request $request
	 *
	 * @return response
	 */
	public function auth($provider, Request $request)
	{

		$provider = $this->getProvider($provider);

		if (!$provider)
			return $this->error(['message' => 'No provider found']);
		
		return redirect($provider->getAuthorizeUrl());

	}

	/**
	 * Request token and generate a new one
	 *
	 * @param string $provider
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function token($provider, Request $request)
	{	


		$provider = $this->getProvider($provider);

		if (!$provider)
			return $this->error(['message' => 'No provider found']);

		$response = $provider->issueToken($request);

		if (!isset($response->access_token))
			return $this->error(['message' => 'Request expired']);

		$provider_user = $provider->getUser($response->access_token);

		$user = $this->manager->getRepository()->findByUsername($provider_user->username);

		if (!$user) {

			$user = $this->manager->create([
				'username' => $provider_user->username,
				'role' => 'user',
				'avatar' => $provider_user->avatar
			]);
		}

		$token = $this->issueAccessToken($user);

		return redirect(route('api.oauth.authenticated')."?token=".$this->serializer->token($token)['access_token']);

	}


	/**
	 * Issue access token
	 *
	 * @param User $user
	 *
	 * @return Response
	 */
	public function issueAccessToken($user)
	{

		$maxGenerationAttempts = \League\OAuth2\Server\Grant\AbstractGrant::MAX_RANDOM_TOKEN_GENERATION_ATTEMPTS;

		$client = (new \Laravel\Passport\ClientRepository())->find(2);
		$scopes = [];

		$accessToken = new AccessToken();
		$accessToken->client()->associate($client);
		$accessToken->user()->associate($user);
		$accessToken->scopes=[];
		$accessToken->revoked = 0;
		$accessToken->expires_at = ((new \DateTime())->add(\Laravel\Passport\Passport::tokensExpireIn()));


		while ($maxGenerationAttempts-- > 0) {
			$accessToken->id = bin2hex(random_bytes(40));
			try {

				$accessToken->save();

				return $accessToken;
			} catch (\Exception $e) {
				if ($maxGenerationAttempts === 0) {
					throw $e;
				}
			}
		}
		return $accessToken;

	}
}
