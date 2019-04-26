<?php

namespace VoIPGRID;

use VoIPGRID\Exception\ClickToDialException;

/**
 * Class ClickToDialConfig
 * The config to set up a new click to dial call.
 *
 * @package VoIPGRID
 */
class ClickToDialConfig
{
    protected $config;

    /**
     * @var array The possible values of a click to dial call.
     */
    protected static $configValues = [
        'auto_answer',
        'b_cli',
        'b_number',
    ];

    /**
     * ClickToDialConfig constructor.
     *
     * @param array $config
     * @throws \VoIPGRID\Exception\ClickToDialException
     */
    public function __construct(array $config) {
        $this->validate($config);

        $this->config = $config;
    }

    /**
     * Validates the values of a click to dial config.
     *
     * @param array $config
     * @throws \VoIPGRID\Exception\ClickToDialException
     */
    private function validate(array $config) {
        $configKeys = array_keys($config);
        $difference = array_diff($configKeys, $this::$configValues);

        if (!empty($difference)) {
            throw new ClickToDialException('Config is not valid');
        }
    }

    /**
     * Retrieves the config.
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }
}