<?php

namespace VoIPGRID\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use \VoIPGRID\Call;
use VoIPGRID\User;

class CallTest extends TestCase
{
    /**
     * Tests the simple call number.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testClickToDialNumber()
    {
        $mock = new MockHandler([
            new Response(200, [],
                '{
                    "a_cli": "+31129876543",
                    "a_number": "238",
                    "auto_answer": false,
                    "b_cli": "+31123456789",
                    "b_number": "+3123456789",
                    "callid": "abcdef123456789",
                    "created": "2019-01-01T01:00:00",
                    "originating_ip": "127.0.0.1",
                    "resource_uri": "/api/clicktodial/abcdef123456789/",
                    "status": ""
                }'
            ),
            new Response(401, ['Unauthorized'])
        ]);
        $handler = HandlerStack::create($mock);

        $client = new Client(['handler' => $handler]);
        $user = new User('jdoe@example.com', 'password123');

        $ctd = new Call($user, $client);
        $result = $ctd->callNumber('01234567890');
        $this->assertSame(true, $result);

        $result = $ctd->callNumber('01234567890');
        $this->assertSame(false, $result);
    }
}