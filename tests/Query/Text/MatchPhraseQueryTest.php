<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class MatchPhraseQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "match_phrase": {
        "message": {
            "query": "this is a test",
            "analyzer": "my_analyzer"
        }
    }
}
JSON
				, [ 'message', "this is a test" ],
				function (MatchPhraseQuery $query) {
					$query->analyzer('my_analyzer');
					return ;
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new MatchPhraseQuery(...$args);
	}
}
