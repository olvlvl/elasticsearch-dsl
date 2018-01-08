<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class TermsQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "terms": {
        "field1": [
            "value1",
            "value2"
        ]
    }
}
JSON
				, [ 'field1', [ 'value1', 'value2' ] ]
			],

			[
				<<<JSON
{
    "terms": {
        "index": "my_index",
        "type": "my_type",
        "id": "123",
        "path": "my_path",
        "routing": "my_routing"
    }
}
JSON
				, [ 'dummy', [] ],
				function (TermsQuery $query) {
					$query
						->index('my_index')
						->type('my_type')
						->id("123")
						->path('my_path')
						->routing('my_routing');
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new TermsQuery(...$args);
	}
}
