<?php

namespace olvlvl\ElasticsearchDSL\Query;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider provideSerialization
	 *
	 * @param string $expected
	 * @param array $args
	 * @param callable|null $config
	 */
	public function testSerialization(string $expected, array $args = [], callable $config = null)
	{
		$instance = $this->makeInstance($args);

		if ($config) {
			$config($instance);
		}

		$this->assertSame($expected, (string) $instance);
	}

	abstract public function provideSerialization(): array;

	abstract protected function makeInstance(array $args);
}
