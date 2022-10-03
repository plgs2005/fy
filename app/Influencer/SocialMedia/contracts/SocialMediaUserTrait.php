<?php

namespace App\Influencer\SocialMedia\contracts;

use App\Influencer\User\User;

trait SocialMediaUserTrait
{
    private $id;
    private $token;
    private $username;

    public function __construct($id, $token, $username = null)
    {
        $this->id = $id;
        $this->token = $token;
        $this->username = $username;
    }

    static public function make(User $user)
    {
        // TODO: está fazendo a consulta na tabela social_media duas vezes
        $id = $user->getSocialMediaId(self::$type);
        $token = $user->getSocialMediaToken(self::$type);
        $username = $user->getSocialMediaUsername(self::$type);
        return new self($id, $token, $username);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getUsername()
    {
        return $this->username;
    }
}
