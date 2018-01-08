<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class RegexpQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "regexp": {
        "name.first": "s.*y"
    }
}
JSON
				, [ 'name.first', "s.*y" ]
			],

			[
				<<<JSON
{
    "regexp": {
        "name.first": {
            "value": "s.*y",
            "boost": 1.5
        }
    }
}
JSON
				, [ 'name.first', "s.*y" ],
				function (RegexpQuery $query) {
					$query->boost(1.5);
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new RegexpQuery(...$args);
	}
}
