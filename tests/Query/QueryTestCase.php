<?php

namespace olvlvl\ElasticsearchDSL\Query;

use PHPUnit\Framework\TestCase;

abstract class QueryTestCase extends TestCase
{
	/**
	 * @dataProvider provideSerialization
	 *
	 * @param callable $init
	 */
	public function testSerialization(callable $init)
	{
		$instance = $this->makeInstance();
		$expected = $init($instance);

		$json = json_encode($instance, JSON_PRETTY_PRINT);

		$this->assertSame($expected, $json);
	}

	abstract public function provideSerialization(): array;

	abstract protected function makeInstance();
}
