<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class MatchQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				[
					'message', "this is a test"
				],
				function () {
					return <<<JSON
{
    "match": {
        "message": "this is a test"
    }
}
JSON;
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new MatchQuery(...$args);
	}
}
