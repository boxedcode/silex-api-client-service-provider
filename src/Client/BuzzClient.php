<?php

namespace BoxedCode\Silex\Api\Client;

use BoxedCode\Silex\Api\AbstractClient;
use BoxedCode\Silex\Api\ClientInterface;
use Buzz\Browser;

/**
 * Class BuzzClient
 *
 * @package BoxedCode\Silex\Api\Client
 */
class BuzzClient extends AbstractClient implements ClientInterface
{
    /**
     * @var Browser
     */
    private $transport;

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
     */
    public function __construct(Browser $transport)
    {
        $this->transport = $transport;
    }

    /**
     * Execute an Api request
     *
     * @param string $endpoint
     * @param array $payload
     * @param array $options
     * @return mixed
     */
    public function execute(
        $endpoint,
        array $payload,
        array $options = []
    )
    {
        $endpoint = $this->baseEndpoint . $endpoint;

        // set a timeout if applicable
        if(isset($options['timeout'])) {
            $this->transport->getClient()->setTimeout((int)$options['timeout']);
        } else if(isset($this->timeout)) {
            $this->transport->getClient()->setTimeout((int)$this->timeout);
        }

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

}