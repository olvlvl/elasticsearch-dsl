<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

class WildcardQueryTest extends \olvlvl\ElasticsearchDSL\Query\TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				[
					'user', "ki*y"
				],
				function (WildcardQuery $query) {
					return <<<JSON
{
    "wildcard": {
        "user": "ki*y"
    }
}
JSON;
				}
			],

			[
				[
					'user', "ki*y"
				],
				function (WildcardQuery $query) {
					$query
						->boost(1.5);

					return <<<JSON
{
    "wildcard": {
        "user": {
            "value": "ki*y",
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
		return new WildcardQuery(...$args);
	}
}
