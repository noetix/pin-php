<?php

namespace Pin\Test\Charge;

use Pin\Handler;
use Pin\Charge\Retrieve;

class RetrieveTest extends \PHPUnit_Framework_TestCase
{
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
		$obj = new Retrieve('foo');
	}

	public function testInvalidOptions()
	{
		$this->setExpectedException('InvalidArgumentException');

		$obj = new Retrieve(123);
	}

	public function testMethod()
	{
		$obj = new Retrieve('foo');

		$this->assertTrue(in_array($obj->getMethod(), $this->getValidMethods()));
	}

	public function testPath()
	{
		$obj = new Retrieve('foo');

		$this->assertTrue(parse_url($obj->getPath()) !== false);
	}

	public function testData()
	{
		$obj = new Retrieve('foo');

		$this->assertTrue(is_array($obj->getData()));
	}
}