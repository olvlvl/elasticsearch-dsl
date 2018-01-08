<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

class TermsQueryTest extends \olvlvl\ElasticsearchDSL\Query\TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				[ 'field1', [ 'value1', 'value2' ] ],
				function (TermsQuery $query) {
					return <<<JSON
{
    "terms": {
        "field1": [
            "value1",
            "value2"
        ]
    }
}
JSON;
				}
			],

			[
				[ 'dummy', [] ],
				function (TermsQuery $query) {
					$query
						->index('my_index')
						->type('my_type')
						->id("123")
						->path('my_path')
						->routing('my_routing');

					return <<<JSON
{
    "terms": {
        "index": "my_index",
        "type": "my_type",
        "id": "123",
        "path": "my_path",
        "routing": "my_routing"
    }
}
JSON;
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new TermsQuery(...$args);
	}
}
