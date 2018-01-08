<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class TermQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "term": {
        "user": "Kimchy"
    }
}
JSON
				, [ 'user', 'Kimchy' ]
			],

			[
				<<<JSON
{
    "term": {
        "user": {
            "value": "Kimchy",
            "boost": 1.5
        }
    }
}
JSON
				, [ 'user', 'Kimchy' ],
				function (TermQuery $query) {
					$query->boost(1.5);
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new TermQuery(...$args);
	}
}
