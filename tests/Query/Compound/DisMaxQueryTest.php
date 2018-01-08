<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class DisMaxQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "dis_max": {
        "tie_breaker": 0.7,
        "boost": 1.2,
        "queries": [
            {
                "term": {
                    "age": 34
                }
            },
            {
                "term": {
                    "age": 35
                }
            }
        ]
    }
}
JSON
				, [],
				function (DisMaxQuery $query) {
					$query->queries->term("age", 34);
					$query->queries->term("age", 35);
					$query->tie_breaker(0.7)->boost(1.2);
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new DisMaxQuery;
	}
}
