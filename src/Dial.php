<?php

namespace VoIPGRID;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;

/**
 * Class ClickToDial
 *
 * The Click to dial interface.
 * @package VoIPGRID
 */
class Dial
{
    private $user;
    private $endPoint;
    private $client;
    private $status;

    /**
     * Dial constructor.
     * @param \VoIPGRID\User $user
     * @param \GuzzleHttp\ClientInterface|NULL $client
     */
    public function __construct(User $user, ClientInterface $client=null)
    {
        $this->endPoint = '/api/clicktodial/';
        $this->user = $user;
        if ($client) {
            $this->client = $client;
        } else {
            $this->client = new Client();
        }
        Environment::create();
    }

    /**
     * @param \VoIPGRID\DialConfig $config The config object
     * @return bool
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \VoIPGRID\Exception\DialException
     */
    public function call(DialConfig $config): bool
    {
        $platformURL = getenv('PLATFORM_URL');

        try {
            $result = $this->client->request('POST',
                $platformURL . $this->endPoint, [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => $this->user->login(),
                    ],
                    'body'    => json_encode($config->getConfig()),
                ]);
        } catch (ClientException $e) {
            print($e->getMessage());
            return false;
        }

        $this->status = new DialStatus(json_decode($result->getBody(), true));
        print_r($this->status);
        return true;
    }

    /**
     * @param string $number The number to call
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \VoIPGRID\Exception\DialException
     */
    public function callNumber(string $number)
    {
        $config = new DialConfig(['b_number' => $number]);
        return $this->call($config);
    }

    /**
     * Gets the status of a dial call.
     * Cached.
     *
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Requests a new status of a click to dial call.
     *
     * @return bool true if successful.
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \VoIPGRID\Exception\DialException
     */
    public function requestStatus()
    {
        $platformURL = getenv('PLATFORM_URL');

        try {
            $result = $this->client->request('GET',
                $platformURL . $this->status->getUri(), [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => $this->user->login(),
                    ],
                ]);
        } catch(ClientException $e) {
            print($e->getMessage());
            return false;
        }

        $this->status = new DialStatus(json_decode($result->getBody(), true));
        return true;
    }
}