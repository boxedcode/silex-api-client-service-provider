<?php

namespace BoxedCode\Silex\Api;

/**
 * Interface ClientInterface
 *
 * @package BoxedCode\Silex\Api
 */
interface ClientInterface
{
    /**
     * Execute an Api request
     *
     * @param $endpoint
     * @param array $payload
     * @param array $options
     * @return mixed
     */
    public function execute(
        $endpoint,
        array $payload,
        array $options = []
    );

    /**
     * Set a base endpoint
     *
     * @param string $baseEndpoint
     * @return ClientInterface
     */
    public function setBaseEndpoint($baseEndpoint);

    /**
     * Add a header parameter
     *
     * @param string $name
     * @param mixed $value
     * @return ClientInterface
     */
    public function addHeader($name, $value);

    /**
     * Set headers
     *
     * @param array $headers
     * @return ClientInterface
     */
    public function setHeaders(array $headers);

    /**
     * Set a global timeout for all requests
     *
     * @param integer $timeout
     * @return ClientInterface
     */
    public function setTimeout($timeout);
}