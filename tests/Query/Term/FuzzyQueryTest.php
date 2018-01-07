<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

class FuzzyQueryTest extends \olvlvl\ElasticsearchDSL\Query\TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				[
					'user', 'ki'
				],
				function (FuzzyQuery $query) {
					return <<<JSON
{
    "fuzzy": {
        "user": "ki"
    }
}
JSON;
				}
			],

			[
				[
					'user', 'ki'
				],
				function (FuzzyQuery $query) {
					$query
						->boost(1.5)
						->fuzziness(2)
						->prefix_length(0)
						->max_expansions(100);

					return <<<JSON
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
JSON;
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new FuzzyQuery(...$args);
	}
}
