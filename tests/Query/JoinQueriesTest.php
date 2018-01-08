<?php

namespace olvlvl\ElasticsearchDSL\Query;

use ICanBoogie\Accessor\AccessorTrait;
use olvlvl\ElasticsearchDSL\Query\Joining\NestedQuery;

class JoinQueriesTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
[
    {
        "nested": {
            "path": "path1",
            "score_mode": "avg",
            "ignore_unmapped": true,
            "query": {
                "term": {
                    "field1": "value1"
                }
            }
        }
    }
]
JSON
				, [],
				function (HasJoiningQueries $query) {
					$query->nested('path1', function (NestedQuery $query) {
						$query->score_mode('avg')->ignore_unmapped(true);
					})->query->term('field1', 'value1');
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new class() implements \JsonSerializable, HasJoiningQueries
		{
			use AccessorTrait;
			use JoiningQueries {
				jsonSerializeJoiningQueries as public jsonSerialize;
			}

			public function __toString()
			{
				return json_encode($this, JSON_PRETTY_PRINT);
			}
		};
	}
}
