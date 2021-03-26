<?php

namespace VoIPGRID;

/**
 * Class User Represents users to use for logging in to the platform.
 *
 * @package VoIPGRID
 */
class User
{
    private $user;
    private $token;

    /**
     * User constructor.
     * @param string $user The username
     * @param string $token The password
     */
    public function __construct(string $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Get the authorization header
     *
     * @return string The header value
     */
    public function login()
    {
        $userPass = $this->user . ':' . $this->token;
        return "Token $userPass";
    }

    /**
     * @return string the username of this user
     */
    public function getUserName(): string
    {
        return $this->user;
    }

    /**
     * @return string the API token of this user.
     */
    public function getToken(): string {
        return $this->token;
    }
}