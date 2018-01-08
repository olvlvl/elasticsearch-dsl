<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class ExistsQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "exists": {
        "field": "user"
    }
}
JSON
				, [ 'user' ],
				function (ExistsQuery $query) {
					return ;
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new ExistsQuery(...$args);
	}
}
