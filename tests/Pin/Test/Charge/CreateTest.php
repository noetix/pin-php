<?php

namespace Pin\Test\Charge;

use Pin\Charge\Create;

class CreateTest extends \PHPUnit_Framework_TestCase
{
    private function getValidCardOptions()
    {
        return array(
            'amount'      => 400,
            'currency'    => 'USD',
            'description' => 'test charge',
            'email'       => 'roland@pin.net.au',
            'ip_address'  => '203.192.1.172',
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
            'amount'      => 400,
            'currency'    => 'AUD',
            'description' => 'test charge',
            'email'       => 'roland@pin.net.au',
            'ip_address'  => '203.192.1.172',
            'card_token'  => 'foo',
        );
    }

    private function getValidCustomerTokenOptions()
    {
        return array(
            'amount'         => 400,
            'description'    => 'test charge',
            'email'          => 'roland@pin.net.au',
            'ip_address'     => '203.192.1.172',
            'customer_token' => 'bar',
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

    public function getValidCurrencies()
    {
        return array(
            array('AUD'),
            array('USD'),
            array('NZD'),
            array('SGD'),
            array('EUR'),
            array('GBP')
        );
    }

    public function testValidCardOptions()
    {
        $obj = new Create($this->getValidCardOptions());
    }

    /**
     * @dataProvider getValidCurrencies
     */
    public function testValidCurrencies($currency)
    {
        $charge = $this->getValidCardOptions();
        $charge['currency'] = $currency;

        $obj = new Create($charge);
    }

    public function testValidCardTokenOptions()
    {
        $obj = new Create($this->getValidCardTokenOptions());
    }

    public function testValidCustomerTokenOptions()
    {
        $obj = new Create($this->getValidCustomerTokenOptions());
    }

    public function testInvalidOptions()
    {
        $this->setExpectedException('InvalidArgumentException');

        $obj = new Create(array('foo' => 'bar'));
    }

    public function testMethod()
    {
        $obj = new Create($this->getValidCardOptions());

        $this->assertTrue(in_array($obj->getMethod(), $this->getValidMethods()));
    }

    public function testPath()
    {
        $obj = new Create($this->getValidCardTokenOptions());

        $this->assertTrue(parse_url($obj->getPath()) !== false);
    }

    public function testData()
    {
        $obj = new Create($this->getValidCustomerTokenOptions());

        $this->assertTrue(is_array($obj->getData()));
    }
}
