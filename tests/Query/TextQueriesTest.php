<?php

namespace olvlvl\ElasticsearchDSL\Query;

use olvlvl\ElasticsearchDSL\Query\Text\MatchAllQuery;
use olvlvl\ElasticsearchDSL\Query\Text\MatchPhrasePrefixQuery;
use olvlvl\ElasticsearchDSL\Query\Text\MatchPhraseQuery;
use olvlvl\ElasticsearchDSL\Query\Text\MatchQuery;
use olvlvl\ElasticsearchDSL\Query\Text\MultiMatchQuery;

class TextQueriesTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
[
    {
        "match_all": {
            "boost": 1.3
        }
    }
]
JSON
				, [],
				function (HasTextQueries $query) {
					$query->match_all(function (MatchAllQuery $match_all) {
						$match_all->boost(1.3);
					});
				}
			],

			[
				<<<JSON
[
    {
        "match": {
            "field1": "query1"
        }
    }
]
JSON
				, [],
				function (HasTextQueries $query) {
					$query->match('field1', 'query1');
				}
			],

			[
				<<<JSON
[
    {
        "match": {
            "field1": "query1"
        }
    },
    {
        "match": {
            "field2": {
                "query": "query2",
                "operator": "and",
                "zero_terms_query": "all",
                "cutoff_frequency": 0.5,
                "fuzziness": "AUTO"
            }
        }
    }
]
JSON
				, [],
				function (HasTextQueries $query) {
					$query->match('field1', 'query1')
						->match('field2', 'query2', function(MatchQuery $match) {
							$match
								->operator('and')
								->zero_terms_query('all')
								->cutoff_frequency(.5)
								->fuzziness('AUTO');
						});
				}
			],

			[
				<<<JSON
[
    {
        "match_phrase": {
            "field1": "query1"
        }
    }
]
JSON
				, [],
				function (HasTextQueries $query) {
					$query->match_phrase('field1', 'query1');
				}
			],

			[
				<<<JSON
[
    {
        "match_phrase": {
            "field1": "query1"
        }
    },
    {
        "match_phrase": {
            "field2": {
                "query": "query2",
                "analyzer": "my_analyser"
            }
        }
    }
]
JSON
				, [],
				function (HasTextQueries $query) {
					$query->match_phrase('field1', 'query1')
						->match_phrase('field2', 'query2', function (MatchPhraseQuery $match_phrase) {
							$match_phrase->analyzer('my_analyser');
						});
				}
			],

			[
				<<<JSON
[
    {
        "match_phrase_prefix": {
            "field1": "query1"
        }
    }
]
JSON
				, [],
				function (HasTextQueries $query) {
					$query->match_phrase_prefix('field1', 'query1');
				}
			],

			[
				<<<JSON
[
    {
        "match_phrase_prefix": {
            "field1": "query1"
        }
    },
    {
        "match_phrase_prefix": {
            "field2": {
                "query": "query2",
                "analyzer": "my_analyser",
                "max_expansions": 10
            }
        }
    }
]
JSON
				, [],
				function (HasTextQueries $query) {
					$query->match_phrase_prefix('field1', 'query1')
						->match_phrase_prefix(
							'field2',
							'query2',
							function (MatchPhrasePrefixQuery $query) {
								$query
									->analyzer('my_analyser')
									->max_expansions(10);
							}
						);
				}
			],

			[
				<<<JSON
[
    {
        "multi_match": {
            "query": "query1",
            "fields": [
                "fields1",
                "fields2"
            ]
        }
    }
]
JSON
				, [],
				function (HasTextQueries $query) {
					$query->multi_match([ 'fields1', 'fields2' ], 'query1');
				}
			],

			[
				<<<JSON
[
    {
        "multi_match": {
            "query": "query1",
            "fields": [
                "fields1",
                "fields2"
            ]
        }
    },
    {
        "multi_match": {
            "query": "query2",
            "fields": [
                "fields3",
                "fields4"
            ],
            "operator": "and",
            "type": "best_fields",
            "tie_breaker": 0.3
        }
    }
]
JSON
				, [],
				function (HasTextQueries $query) {
					$query->multi_match([ 'fields1', 'fields2' ], 'query1')
						->multi_match(
							[ 'fields3', 'fields4' ],
							'query2',
							function (MultiMatchQuery $q) {
								$q
									->operator('and')
									->type('best_fields')
									->tie_breaker(.3);
							}
						);
				}
			],
		];
	}

	protected function makeInstance(array $args)
	{
		return new class() implements \JsonSerializable, HasTextQueries
		{
			use TextQueries {
				jsonSerializeTextQueries as public jsonSerialize;
			}

			public function __toString()
			{
				return json_encode($this, JSON_PRETTY_PRINT);
			}
		};
	}
}
