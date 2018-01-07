<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class MatchAllQueryTest extends TestCase
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
    "match_all": {}
}
JSON;
				}
			],

			[
				[
				],
				function (MatchAllQuery $query) {
					$query->boost(1.5);
					return <<<JSON
{
    "match_all": {
        "boost": 1.5
    }
}
JSON;
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new MatchAllQuery(...$args);
	}
}
