<?php

namespace Pin\Test;

use Pin\Handler;
use Pin\Customer\Create;

class HandlerTest extends \PHPUnit_Framework_TestCase
{
    public function getValidOptions()
    {
        return array('key' => 'foo');
    }

    public function testBadArguements()
    {
        $this->setExpectedException('InvalidArgumentException');

        $handler = new Handler(array('foo' => 'bar'));
    }

    public function testGetValidTransport()
    {
        $handler = new Handler($this->getValidOptions());

        $browser = $handler->getTransport();
        $this->assertContainsOnlyInstancesOf('Buzz\Browser', array($browser));
    }

    public function testGetValidTransportDriver()
    {
        $handler = new Handler($this->getValidOptions());

        $driver = $handler->getTransport()->getClient();
        $this->assertContainsOnlyInstancesOf('Buzz\Client\Curl', array($driver));
    }
}
