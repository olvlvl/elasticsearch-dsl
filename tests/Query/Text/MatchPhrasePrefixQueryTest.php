<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class MatchPhrasePrefixQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "match_phrase_prefix": {
        "message": {
            "query": "quick brown f",
            "max_expansions": 10
        }
    }
}
JSON
				, [ 'message', "quick brown f" ],
				function (MatchPhrasePrefixQuery $query) {
					$query->max_expansions(10);
					return ;
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new MatchPhrasePrefixQuery(...$args);
	}
}
