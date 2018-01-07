<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

class TermQueryTest extends \olvlvl\ElasticsearchDSL\Query\TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				[
					'user', 'Kimchy'
				],
				function (TermQuery $query) {
					return <<<JSON
{
    "term": {
        "user": "Kimchy"
    }
}
JSON;
				}
			],

			[
				[
					'user', 'Kimchy'
				],
				function (TermQuery $query) {
					$query
						->boost(1.5);

					return <<<JSON
{
    "term": {
        "user": {
            "value": "Kimchy",
            "boost": 1.5
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
		return new TermQuery(...$args);
	}
}
