<?php

namespace VoIPGRID;

/**
 * Class ClickToDialStatus
 * The status of a click to dial call.
 *
 * @package VoIPGRID
 */
class DialStatus extends DialConfig
{
    /**
     * Possible values in the status object.
     *
     * @var array
     */
    protected static $configValues = [
        'a_cli',
        'a_number',
        'auto_answer',
        'b_cli',
        'b_number',
        'callid',
        'created',
        'originating_ip',
        'resource_uri',
        'status',
    ];

    /**
     * Retrieves the status values.
     *
     * @return array
     */
    public function getStatus()
    {
        return $this->config;
    }

    /**
     * Returns the status URI of a click to dial object.
     *
     * @return mixed
     */
    public function getUri()
    {
        return $this->config['resource_uri'];
    }
}