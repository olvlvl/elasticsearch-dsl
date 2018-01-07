<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class MatchNoneQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				[
				],
				function () {
					return <<<JSON
{
    "match_none": {}
}
JSON;
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new MatchNoneQuery(...$args);
	}
}
