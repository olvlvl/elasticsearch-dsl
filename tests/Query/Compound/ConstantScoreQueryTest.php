<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class ConstantScoreQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "constant_score": {
        "filter": {
            "term": {
                "user": "kimchy"
            }
        },
        "boost": 1.2
    }
}
JSON
				, [ 1.2 ],
				function (ConstantScoreQuery $query) {
					$query->filter->term("user", "kimchy");
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new ConstantScoreQuery(...$args);
	}
}
