<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class MatchQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "match": {
        "message": "this is a test"
    }
}
JSON
				, [ 'message', "this is a test" ]
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new MatchQuery(...$args);
	}
}
