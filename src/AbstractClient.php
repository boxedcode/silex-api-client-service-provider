<?php

namespace BoxedCode\Silex\Api;

/**
 * Class AbstractClient
 *
 * @package BoxedCode\Silex\Api
 */
abstract class AbstractClient
{
    /**
     * @var string
     */
    protected $baseEndpoint = '';

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var integer
     */
    protected $timeout;

    /**
     * Set a base endpoint
     *
     * @param string $baseEndpoint
     * @return ClientInterface
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
     * Set a global timeout for all requests
     *
     * @param integer $timeout
     * @return ClientInterface
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

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