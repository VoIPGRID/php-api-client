<?php

namespace VoIPGRID\Tests;

use PHPUnit\Framework\TestCase;
use VoIPGRID\DialConfig;
use VoIPGRID\Exception\DialException;

/**
 * Class ClickToDialConfigTest
 *
 * @package VoIPGRID\Tests
 */
class DialConfigTest extends TestCase
{
    /**
     * Tests the complex call function.
     *
     * @throws \VoIPGRID\Exception\DialException
     */
    public function testConfig()
    {
        $config = new DialConfig([
            'b_number' => '01234567890',
        ]);

        $this->assertSame(['b_number' => '01234567890'], $config->getConfig());

        $config = new DialConfig([
            'b_number' => '09876543210',
            'b_cli' => '01234567890',
            'auto_answer' => false,
        ]);
        $this->assertSame(
            [
                'b_number' => '09876543210',
                'b_cli' => '01234567890',
                'auto_answer' => false,
            ],
            $config->getConfig()
        );

        $this->expectException(DialException::class);
        $config = new DialConfig([
            'b_number' => '01234567890',
            'foo' => 'bar',
        ]);
    }
}