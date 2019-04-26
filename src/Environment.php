<?php

namespace VoIPGRID;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

/**
 * Class Environment
 *
 * Make sure the environment is properly initialized.
 *
 * @package VoIPGRID
 */
class Environment
{
    /**
     * Initialize the environment.
     */
    public static function create()
    {
        try {
            $dotEnv = Dotenv::create(__DIR__ . '/../');
            $dotEnv->load();
        } catch (InvalidPathException $e) {
            // @TODO: Do something here.
        }
    }
}