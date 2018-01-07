<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

class IdsQueryTest extends \olvlvl\ElasticsearchDSL\Query\TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				[ [ "1", "4", "100" ] ],
				function () {
					return <<<JSON
{
    "ids": {
        "values": [
            "1",
            "4",
            "100"
        ]
    }
}
JSON;

				}
			],

			[
				[ [ "1", "4", "100" ] ],
				function (IdsQuery $query) {
					$query->type("my_type");

					return <<<JSON
{
    "ids": {
        "values": [
            "1",
            "4",
            "100"
        ],
        "type": "my_type"
    }
}
JSON;

				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new IdsQuery(...$args);
	}
}
