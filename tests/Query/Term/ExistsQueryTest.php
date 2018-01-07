<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

class ExistsQueryTest extends \olvlvl\ElasticsearchDSL\Query\TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				[
					'user'
				],
				function (ExistsQuery $query) {
					return <<<JSON
{
    "exists": {
        "field": "user"
    }
}
JSON;
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new ExistsQuery(...$args);
	}
}
