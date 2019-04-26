<?php

namespace VoIPGRID\Tests;

use PHPUnit\Framework\TestCase;
use VoIPGRID\ClickToDialConfig;
use VoIPGRID\Exception\ClickToDialException;

/**
 * Class ClickToDialConfigTest
 *
 * @package VoIPGRID\Tests
 */
class ClickToDialConfigTest extends TestCase
{
    /**
     * Tests the complex call function.
     *
     * @throws \VoIPGRID\Exception\ClickToDialException
     */
    public function testConfig()
    {
        $config = new ClickToDialConfig([
            'b_number' => '01234567890',
        ]);

        $this->assertSame(['b_number' => '01234567890'], $config->getConfig());

        $config = new ClickToDialConfig([
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

        $this->expectException(ClickToDialException::class);
        $config = new ClickToDialConfig([
            'b_number' => '01234567890',
            'foo' => 'bar',
        ]);
    }
}