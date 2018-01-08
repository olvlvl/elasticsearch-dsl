<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class WildcardQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "wildcard": {
        "user": "ki*y"
    }
}
JSON
				, [ 'user', "ki*y" ]
			],

			[
				<<<JSON
{
    "wildcard": {
        "user": {
            "value": "ki*y",
            "boost": 1.5
        }
    }
}
JSON
				, [ 'user', "ki*y" ],
				function (WildcardQuery $query) {
					$query->boost(1.5);
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new WildcardQuery(...$args);
	}
}
