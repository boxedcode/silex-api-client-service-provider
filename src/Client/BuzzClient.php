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
     * Headers
     *
     * @var array
     */
    protected $headers = [
        'Content-Type' => 'application/json',
        'Connection' => 'close'
    ];

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
        $response = $this->transport->post($endpoint,
            $this->getHeaders(),
            json_encode([
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

    /**
     * Add a header parameter
     *
     * @param string $name
     * @param mixed $value
     * @return ClientInterface
     */
    public function addHeader($name, $value)
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * Set headers
     *
     * @param array $headers
     * @return ClientInterface
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }


    /**
     * Get headers
     *
     * @return array
     */
    protected function getHeaders()
    {
        return $this->headers;
    }
}