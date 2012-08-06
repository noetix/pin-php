<?php

namespace Pin\Test;

use Pin\Handler;
use Pin\Customer\Create;

class HandlerTest extends \PHPUnit_Framework_TestCase
{
	public function testBadArguements()
	{
		$this->setExpectedException('InvalidArgumentException');

		$handler = new Handler(array('foo' => 'bar'));
	}
}