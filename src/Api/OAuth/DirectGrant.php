<?php

namespace Api\OAuth;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use League\OAuth2\Server\RequestEvent;
use League\OAuth2\Server\ResponseTypes\ResponseTypeInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Password grant class.
 */
class DirectGrant extends AbstractGrant
{



	/**
	 * Issue an access token.
	 *
	 * @param \DateInterval		  $accessTokenTTL
	 * @param ClientEntityInterface  $client
	 * @param string				 $userIdentifier
	 * @param ScopeEntityInterface[] $scopes
	 *
	 * @throws OAuthServerException
	 * @throws UniqueTokenIdentifierConstraintViolationException
	 *
	 * @return AccessTokenEntityInterface
	 */
	protected function issueAccessToken(
		\DateInterval $accessTokenTTL,
		ClientEntityInterface $client,
		$userIdentifier,
		array $scopes = []
	) {
		$maxGenerationAttempts = self::MAX_RANDOM_TOKEN_GENERATION_ATTEMPTS;

		$accessToken = $this->accessTokenRepository->getNewToken($client, $scopes, $userIdentifier);
		$accessToken->setClient($client);
		$accessToken->setUserIdentifier($userIdentifier);
		$accessToken->setExpiryDateTime((new \DateTime())->add($accessTokenTTL));

		foreach ($scopes as $scope) {
			$accessToken->addScope($scope);
		}

		while ($maxGenerationAttempts-- > 0) {
			$accessToken->setIdentifier($this->generateUniqueIdentifier());
			try {
				$this->accessTokenRepository->persistNewAccessToken($accessToken);

				return $accessToken;
			} catch (UniqueTokenIdentifierConstraintViolationException $e) {
				if ($maxGenerationAttempts === 0) {
					throw $e;
				}
			}
		}
	}


}
