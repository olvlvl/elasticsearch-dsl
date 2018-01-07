<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

class RegexpQueryTest extends \olvlvl\ElasticsearchDSL\Query\TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				[
					'name.first', "s.*y"
				],
				function (RegexpQuery $query) {
					return <<<JSON
{
    "regexp": {
        "name.first": "s.*y"
    }
}
JSON;
				}
			],

			[
				[
					'name.first', "s.*y"
				],
				function (RegexpQuery $query) {
					$query
						->boost(1.5);

					return <<<JSON
{
    "regexp": {
        "name.first": {
            "value": "s.*y",
            "boost": 1.5
        }
    }
}
JSON;
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new RegexpQuery(...$args);
	}
}
