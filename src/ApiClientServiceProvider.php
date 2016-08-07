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
        $pimple['api.client'] = function () use ($pimple) {
            $baseEndpoint = $pimple['base_endpoint'] ?: '';
            $timeout = isset($pimple['timeout']) ? $pimple['timeout'] : null;

            return $this
                ->getClient()
                ->setBaseEndpoint($baseEndpoint)
                ->setTimeout($timeout);
        };
    }

    /**
     * Get an API client implementation
     *
     * @return BuzzClient
     */
    protected function getClient()
    {
        return new BuzzClient(new Browser());
    }
}