<?php

require_once __DIR__ . '/../../app/AppKernel.php';

class Issue75Test extends \PHPUnit_Framework_TestCase
{
    private $app;
    private $container;

    public function setUp()
    {
        $this->app = new \AppKernel('', __DIR__ . '/config.yml', 'test', true);
        $this->app->boot();
        $this->container = $this->app->getContainer();
    }

    public function testLazyConnection()
    {
        $bucket = $this->container->get('ic_base_riak.bucket.test');
        $bucket->delete('test');
    }
}
