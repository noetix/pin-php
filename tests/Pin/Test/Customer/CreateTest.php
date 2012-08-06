<?php

namespace Pin\Test\Customer;

use Pin\Handler;
use Pin\Customer\Create;

class CreateTest extends \PHPUnit_Framework_TestCase
{
    private function getValidOptions()
    {
        return array(
            'email'       => 'roland@pin.net.au',
            'card'        => array(
                'number'           => '5520000000000000',
                'expiry_month'     => '05',
                'expiry_year'      => '2013',
                'cvc'              => '123',
                'name'             => 'Roland Robot',
                'address_line1'    => '42 Sevenoaks St',
                'address_city'     => 'Lathlain',
                'address_postcode' => '6454',
                'address_state'    => 'WA',
                'address_country'  => 'AU'),
        );
    }

    private function getValidCardTokenOptions()
    {
        return array(
            'email'      => 'roland@pin.net.au',
            'card_token' => 'foo',
        );
    }

    private function getValidMethods()
    {
        $r = new \ReflectionClass('Pin\RequestInterface');
        $methods = array();

        foreach ($r->getConstants() AS $key => $value) {
            if (substr($key, 0, strlen('METHOD_')) === 'METHOD_') {
                $methods[] = $value;
            }
        }

        return $methods;
    }

    public function testValidOptions()
    {
        $obj = new Create($this->getValidOptions());
    }

    public function testValidCardTokenOptions()
    {
        $obj = new Create($this->getValidCardTokenOptions());
    }

    public function testInvalidOptions()
    {
        $this->setExpectedException('InvalidArgumentException');

        $obj = new Create(array('foo' => 'bar'));
    }

    public function testMethod()
    {
        $obj = new Create($this->getValidOptions());

        $this->assertTrue(in_array($obj->getMethod(), $this->getValidMethods()));
    }

    public function testPath()
    {
        $obj = new Create($this->getValidOptions());

        $this->assertTrue(parse_url($obj->getPath()) !== false);
    }

    public function testData()
    {
        $obj = new Create($this->getValidOptions());

        $this->assertTrue(is_array($obj->getData()));
    }
}