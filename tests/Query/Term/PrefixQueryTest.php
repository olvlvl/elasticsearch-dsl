<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

class PrefixQueryTest extends \olvlvl\ElasticsearchDSL\Query\TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				[
					'user', 'ki'
				],
				function (PrefixQuery $query) {
					return <<<JSON
{
    "prefix": {
        "user": "ki"
    }
}
JSON;
				}
			],

			[
				[
					'user', 'ki'
				],
				function (PrefixQuery $query) {
					$query
						->boost(1.5);

					return <<<JSON
{
    "prefix": {
        "user": {
            "value": "ki",
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
		return new PrefixQuery(...$args);
	}
}
