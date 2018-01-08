<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class TypeQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "type": {
        "value": "my_type"
    }
}
JSON
				, [ 'my_type' ]
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new TypeQuery(...$args);
	}
}
