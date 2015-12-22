<?php

namespace BoxedCode\Silex\Api\Client;

use Buzz\Browser;

/**
 * Class BuzzClientTest
 *
 * @package BoxedCode\Silex\Api\Client
 */
class BuzzClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BuzzClient
     */
    protected $client;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->client = new BuzzClient(new Browser(), null);
    }

    /**
     * Test that the buzz client implements the client interface
     */
    public function testImplementsClientInterface()
    {
        $this->assertInstanceOf('\BoxedCode\Silex\Api\ClientInterface', $this->client);
    }
}