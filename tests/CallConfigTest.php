<?php

namespace VoIPGRID\Tests;

use PHPUnit\Framework\TestCase;
use VoIPGRID\CallConfig;
use VoIPGRID\Exception\CallException;

/**
 * Class ClickToDialConfigTest
 *
 * @package VoIPGRID\Tests
 */
class CallConfigTest extends TestCase
{
    /**
     * Tests the complex call function.
     *
     * @throws \VoIPGRID\Exception\CallException
     */
    public function testConfig()
    {
        $config = new CallConfig([
            'to' => '01234567890',
        ]);

        $this->assertSame(['b_number' => '01234567890'], $config->getConfig());

        $config = new CallConfig([
            'to' => '09876543210',
            'auto_answer' => false,
        ]);
        $this->assertSame(
            [
                'b_number' => '09876543210',
                'auto_answer' => false,
            ],
            $config->getConfig()
        );

        $this->expectException(CallException::class);
        $config = new CallConfig([
            'to' => '01234567890',
            'foo' => 'bar',
        ]);
    }
}