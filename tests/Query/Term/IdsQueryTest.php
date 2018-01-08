<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class IdsQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "ids": {
        "values": [
            "1",
            "4",
            "100"
        ]
    }
}
JSON
				, [ [ "1", "4", "100" ] ]
			],

			[
				<<<JSON
{
    "ids": {
        "values": [
            "1",
            "4",
            "100"
        ],
        "type": "my_type"
    }
}
JSON
				, [ [ "1", "4", "100" ] ],
				function (IdsQuery $query) {
					$query->type("my_type");
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new IdsQuery(...$args);
	}
}
