<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class FuzzyQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "fuzzy": {
        "user": "ki"
    }
}
JSON
				, [ 'user', 'ki' ]
			],

			[
				<<<JSON
{
    "fuzzy": {
        "user": {
            "value": "ki",
            "boost": 1.5,
            "fuzziness": 2,
            "prefix_length": 0,
            "max_expansions": 100
        }
    }
}
JSON
				, [ 'user', 'ki' ],
				function (FuzzyQuery $query) {
					$query
						->boost(1.5)
						->fuzziness(2)
						->prefix_length(0)
						->max_expansions(100);
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new FuzzyQuery(...$args);
	}
}
