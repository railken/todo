<?php

namespace Api\OAuth;

class Provider
{

	/**
	 * Client ID
	 *
	 * @var string
	 */
	protected $client_id;

	/**
	 * Client Secret
	 *
	 * @var string
	 */
	protected $client_secret;

	/**
	 * Return redirect url
	 *
	 * @return string
	 */
	public function getRedirectUri()
	{
		return env("APP_URL")."/api/v1/oauth/{$this->name}/token/";
	}
}