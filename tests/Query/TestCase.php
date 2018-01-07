<?php

namespace olvlvl\ElasticsearchDSL\Query;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider provideSerialization
	 *
	 * @param array $args
	 * @param callable $builder
	 */
	public function testSerialization(array $args, callable $builder)
	{
		$instance = $this->makeInstance($args);
		$expected = $builder($instance);

		$this->assertSame($expected, (string) $instance);
	}

	abstract public function provideSerialization(): array;

	abstract protected function makeInstance(array $args);
}
