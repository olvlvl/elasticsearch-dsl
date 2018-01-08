<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class BoostingQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "boosting": {
        "positive": {
            "term": {
                "field1": "value1"
            }
        },
        "negative": {
            "term": {
                "field2": "value2"
            }
        },
        "negative_boost": 0.2
    }
}
JSON
				, [ .2 ],
				function (BoostingQuery $query) {
					$query->positive->term("field1", "value1");
					$query->negative->term("field2", "value2");
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new BoostingQuery(...$args);
	}
}
