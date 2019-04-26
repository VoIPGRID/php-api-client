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
    private $password;
    private $token;

    /**
     * User constructor.
     * @param string $user The username
     * @param string $password The password
     */
    public function __construct(string $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
        $this->token = null;
    }

    /**
     * Sets the 2FA token
     *
     * @param string $token The 2FA token
     */
    public function setToken(string $token) {
        $this->token = $token;
    }

    /**
     * Get the authorization header
     *
     * @return string The header value
     */
    public function login()
    {
        if ($this->token !== null) {
            $userPass = $this->user . ':' . $this->token;
            return "Token $userPass";
        } else {
            $userPass = base64_encode($this->user . ':' . $this->password);
            return "Basic $userPass";
        }
    }

    /**
     * @return string the username of this user
     */
    public function getUserName(): string
    {
        return $this->user;
    }

    /**
     * @return string the password of this user.
     */
    public function getPassword(): string {
        return $this->password;
    }
}