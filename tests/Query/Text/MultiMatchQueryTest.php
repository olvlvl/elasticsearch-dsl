<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class MultiMatchQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				[
					[ 'subject', 'message' ], "this is a test"
				],
				function () {
					return <<<JSON
{
    "multi_match": {
        "query": "this is a test",
        "fields": [
            "subject",
            "message"
        ]
    }
}
JSON;
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new MultiMatchQuery(...$args);
	}
}
