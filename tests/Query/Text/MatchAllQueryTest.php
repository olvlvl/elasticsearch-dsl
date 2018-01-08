<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class MatchAllQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "match_all": {}
}
JSON
			],

			[
				<<<JSON
{
    "match_all": {
        "boost": 1.5
    }
}
JSON
				, [],
				function (MatchAllQuery $query) {
					$query->boost(1.5);
					return ;
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new MatchAllQuery;
	}
}
