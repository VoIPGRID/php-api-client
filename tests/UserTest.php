<?php

namespace VoIPGRID\Tests;

use PHPUnit\Framework\TestCase;
use \VoIPGRID\User;

class UserTest extends TestCase
{
    /**
     * Tests the user class.
     */
    public function testUserClass()
    {
        $user = new User('jdoe@example.com', 'some-random-token');

        $this->assertSame('jdoe@example.com', $user->getUserName());
        $this->assertSame('some-random-token', $user->getToken());
    }
}