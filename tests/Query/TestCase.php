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

		$json = json_encode($instance, JSON_PRETTY_PRINT);

		$this->assertSame($expected, $json);
	}

	abstract public function provideSerialization(): array;

	abstract protected function makeInstance(array $args);
}
