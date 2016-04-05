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
     * @return mixed
     */
    public function execute($endpoint, array $payload);

    /**
     * Set a base endpoint
     *
     * @param string $baseEndpoint
     * @return mixed
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
}