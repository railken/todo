<?php

namespace Core\User;

use Core\User\User;
use League\OAuth2\Server\CryptKey;

use Core\Project\ProjectSerializer;

class UserSerializer
{
    public function user(User $user)
    {
        return [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'projects' => $this->projects($user->projects)
        ];
    }

    public function projects($projects)
    {
        $serializer = new ProjectSerializer;

        return $projects->map(function ($project) use ($serializer) {
            return $serializer->all($project);
        });
    }

    public function token($token)
    {
        return [
            'access_token' => (string)$token->convertToJWT(new CryptKey('file://'.\Laravel\Passport\Passport::keyPath('oauth-private.key'))),
            'token_type' => 'bearer',
            'expire_in' => $token->expires_at->getTimestamp() - time()
        ];
    }
}
