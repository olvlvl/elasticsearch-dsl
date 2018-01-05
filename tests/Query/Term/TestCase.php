<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider provideSerialization
	 *
	 * @param array $arguments
	 * @param array $expected
	 */
	public function testSerialization(array $arguments, array $expected)
	{
		$class = $this->getQueryClass();
		$query = new $class(...$arguments);

		$this->assertSame([ constant("$class::NAME") => $expected ], json_decode(json_encode($query), true));
	}

	abstract public function getQueryClass(): string;
	abstract public function provideSerialization(): array;
}
