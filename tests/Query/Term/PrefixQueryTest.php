<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class PrefixQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "prefix": {
        "user": "ki"
    }
}
JSON
				, [ 'user', 'ki' ]
			],

			[
				<<<JSON
{
    "prefix": {
        "user": {
            "value": "ki",
            "boost": 1.5
        }
    }
}
JSON
				, [ 'user', 'ki' ],
				function (PrefixQuery $query) {
					$query
						->boost(1.5);
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new PrefixQuery(...$args);
	}
}
