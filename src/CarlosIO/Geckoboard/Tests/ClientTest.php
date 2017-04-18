<?php
namespace CarlosIO\Geckoboard\Tests;
use CarlosIO\Geckoboard\Client as Geckoboard;
class ClientTest extends \PHPUnit_Framework_TestCase
{
    const TIMEOUT = 10;
    const API_KEY = 'foo';
    public function testFullMethodsDataEntry()
    {
        $config = ['timeout' => self::TIMEOUT, 'connect_timeout' => 1];
        $client = new Geckoboard($config);
        $this->assertSame(self::API_KEY, $client->setApiKey(self::API_KEY)->getApiKey());
    }
    public function testClient()
    {
        $widget = \Mockery::mock('CarlosIO\Geckoboard\Widgets\Widget');
        $widget->shouldReceive('getId')->andReturn('1');
        $widget->shouldReceive('getData')->andReturn([1, 2, 3]);
        $client = new DummyClient();
        $client->push($widget);
    }
    protected function tearDown()
    {
        \Mockery::close();
    }
}
