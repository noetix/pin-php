<?php

namespace Pin\Test\Charge;

use Pin\Handler;
use Pin\Charge\Refund;

class RefundTest extends \PHPUnit_Framework_TestCase
{
	private function getValidOptions()
	{
		return array(
			'amount' => 400,
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
		$obj = new Refund('foo', $this->getValidOptions());
	}

	public function testInvalidOptions()
	{
		$this->setExpectedException('InvalidArgumentException');

		$obj = new Refund(123, array('foo' => 'bar'));
	}

	public function testMethod()
	{
		$obj = new Refund('foo', $this->getValidOptions());

		$this->assertTrue(in_array($obj->getMethod(), $this->getValidMethods()));
	}

	public function testPath()
	{
		$obj = new Refund('foo', $this->getValidOptions());

		$this->assertTrue(parse_url($obj->getPath()) !== false);
	}

	public function testData()
	{
		$obj = new Refund('foo', $this->getValidOptions());

		$this->assertTrue(is_array($obj->getData()));
	}
}