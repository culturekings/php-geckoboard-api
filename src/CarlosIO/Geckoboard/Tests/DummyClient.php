<?php
namespace CarlosIO\Geckoboard\Tests;
use CarlosIO\Geckoboard\Client;
class DummyClient extends Client
{
    public function __construct()
    {
        parent::__construct();
        $client = \Mockery::mock('stdClass');
        $client->shouldReceive('request')->once();
        $this->client = $client;
    }
}
