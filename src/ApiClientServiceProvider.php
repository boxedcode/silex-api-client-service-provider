<?php

namespace BoxedCode\Silex\Api;

use BoxedCode\Silex\Api\Client\BuzzClient;
use Buzz\Browser;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ApiClientServiceProvider
 *
 * @package BoxedCode\Silex\Api
 */
class ApiClientServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $baseEndpoint = $pimple['base_endpoint'] ?: null;

        $pimple['api.client'] = function () use ($baseEndpoint) {
            return $this->getClient($baseEndpoint);
        };
    }

    /**
     * Get an API client implementation
     *
     * @param $baseEndpoint
     * @return BuzzClient
     */
    protected function getClient($baseEndpoint)
    {
        return new BuzzClient(new Browser(), $baseEndpoint);
    }
}