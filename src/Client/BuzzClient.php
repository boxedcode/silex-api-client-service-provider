<?php

namespace BoxedCode\Silex\Api\Client;

use BoxedCode\Silex\Api\ClientInterface;
use Buzz\Browser;

/**
 * Class BuzzClient
 *
 * @package BoxedCode\Silex\Api\Client
 */
class BuzzClient implements ClientInterface
{
    /**
     * @var Browser
     */
    private $transport;

    /**
     * @var string
     */
    private $baseEndpoint;

    /**
     * BuzzClient constructor.
     *
     * @param Browser $transport
     * @param null|string $baseEndpoint
     */
    public function __construct(Browser $transport, $baseEndpoint = null)
    {
        $this->transport = $transport;
        $this->baseEndpoint = $baseEndpoint;
    }

    /**
     * Execute an Api request
     *
     * @param $endpoint
     * @param array $payload
     * @return mixed
     */
    public function execute($endpoint, array $payload)
    {
        $endpoint = $this->baseEndpoint . $endpoint;
        $response = $this->transport->post($endpoint, [
            'Content-Type' => 'application/json',
            'Connection' => 'close'
        ], json_encode([
            'meta' => [
                'when' => date('Y-m-d H:i:s'),
                'server' => gethostname(),
            ],
            'data' => $payload
        ]));

        return json_decode($response->getContent(), true);
    }

    /**
     * Set a base endpoint
     *
     * @param string $baseEndpoint
     * @return BuzzClient
     */
    public function setBaseEndpoint($baseEndpoint)
    {
        $this->baseEndpoint = $baseEndpoint;

        return $this;
    }

}