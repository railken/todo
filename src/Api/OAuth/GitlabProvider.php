<?php

namespace Api\OAuth;

class GitlabProvider extends Provider
{

    /**
     * Name
     *
     * @var string
     */
    protected $name = 'gitlab';

    /**
     * URL
     *
     * @var string
     */
    protected $url = 'https://gitlab.com/oauth';

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->client_id = env("OAUTH_GITLAB_CLIENT_ID");
        $this->client_secret = env("OAUTH_GITLAB_CLIENT_SECRET");
    }

    /**
     * Retrieve url to authorize user
     *
     * @return string
     */
    public function getAuthorizeUrl()
    {
        return $this->url."/authorize?".http_build_query([
            'client_id' => $this->client_id,
            'redirect_uri' => $this->getRedirectUri(),
            'response_type' => 'code',
            'scope' => 'read_user'
        ]);
    }

    /**
     * Issue access token
     *
     * @return array
     */
    public function issueToken($request)
    {
        $client = new \GuzzleHttp\Client();

        try {
            $params =  [
                'form_params' => [
                    'client_id' => $this->client_id,
                    'client_secret' => $this->client_secret,
                    'code' => $request->input('code'),
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => $this->getRedirectUri(),
                ],
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ];


            $response = $client->request('POST', $this->url."/token", $params);
        } catch (\Exception $e) {
            echo $e;
        }

        $body = json_decode($response->getBody());

        return $body;
    }


    /**
     * Retrieve User
     *
     * @return array
     */
    public function getUser($token)
    {
        $client = new \GuzzleHttp\Client();
        $user = new \stdClass;

        try {
            $response = $client->request('GET', "https://gitlab.com/api/v4/user", [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => "Bearer {$token}"
                ],
                'http_errors' => false
            ]);

            $body = json_decode($response->getBody());
        } catch (\Exception $e) {
            return $this->error([]);
        }

        $user->username = $body->name;
        $user->avatar = $body->avatar_url;
        $user->email = $body->email;

        return $user;
    }
}
