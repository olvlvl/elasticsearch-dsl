<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

class TypeQueryTest extends \olvlvl\ElasticsearchDSL\Query\TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				[
					'my_type'
				],
				function (TypeQuery $query) {
					return <<<JSON
{
    "type": {
        "value": "my_type"
    }
}
JSON;
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new TypeQuery(...$args);
	}
}
