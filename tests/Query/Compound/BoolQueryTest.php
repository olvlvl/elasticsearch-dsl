<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound;

use olvlvl\ElasticsearchDSL\Query\Term\RangeQuery;
use olvlvl\ElasticsearchDSL\Query\TestCase;

class BoolQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "bool": {
        "must": {
            "term": {
                "user": "kimchy"
            }
        },
        "filter": {
            "term": {
                "tag": "tech"
            }
        },
        "should": [
            {
                "term": {
                    "tag": "wow"
                }
            },
            {
                "term": {
                    "tag": "elasticsearch"
                }
            }
        ],
        "must_not": {
            "range": {
                "age": {
                    "gte": 10,
                    "lte": 20
                }
            }
        },
        "minimum_should_match": 1,
        "boost": 1.5
    }
}
JSON
				, [],
				function (BoolQuery $query) {
					$query->minimum_should_match(1)
						->boost(1.5);
					$query->must->term("user", "kimchy");
					$query->filter->term("tag", "tech");
					$query->must_not->range("age", function (RangeQuery $range) {
						$range->gte(10)->lte(20);
					});
					$query->should
						->term("tag", "wow")
						->term("tag", "elasticsearch");
				}
			],

			[
				<<<JSON
{
    "bool": {
        "must": {
            "term": {
                "preference_1": "Apples"
            }
        }
    }
}
JSON
				,[],
				function (BoolQuery $query) {
					$query->must
						->term("preference_1", "Apples");
				}
			],

			[
				<<<JSON
{
    "bool": {
        "must": [
            {
                "term": {
                    "preference_1": "Apples"
                }
            },
            {
                "term": {
                    "preference_2": "Banana"
                }
            }
        ]
    }
}
JSON
				, [],
				function (BoolQuery $query) {
					$query->must
						->term("preference_1", "Apples")
						->term("preference_2", "Banana");
				}
			],

			[
				<<<JSON
{
    "bool": {
        "must": [
            {
                "term": {
                    "preference_1": "Apples"
                }
            },
            {
                "term": {
                    "preference_2": "Banana"
                }
            },
            {
                "terms": {
                    "preference_3": [
                        "One",
                        "Two"
                    ]
                }
            }
        ]
    }
}
JSON
				, [],
				function (BoolQuery $query) {
					$query->must
						->term("preference_1", "Apples")
						->term("preference_2", "Banana")
						->terms("preference_3", [ "One", "Two" ]);
				}
			],

			[
				<<<JSON
{
    "bool": {
        "must": [
            {
                "term": {
                    "preference_1": "Apples"
                }
            },
            {
                "term": {
                    "preference_2": "Banana"
                }
            },
            {
                "terms": {
                    "preference_3": [
                        "One",
                        "Two"
                    ]
                }
            }
        ],
        "filter": {
            "term": {
                "preference_4": "Orange"
            }
        },
        "should": {
            "match": {
                "field_1": "Kiwi"
            }
        }
    }
}
JSON
				, [],
				function (BoolQuery $query) {
					$query->must
						->term("preference_1", "Apples")
						->term("preference_2", "Banana")
						->terms("preference_3", [ "One", "Two" ]);
					$query->filter
						->term("preference_4", "Orange");
					$query->should
						->match("field_1", "Kiwi");
				}
			],

			[
				<<<JSON
{
    "bool": {
        "must": {
            "bool": {
                "filter": {
                    "term": {
                        "field_2": "two"
                    }
                }
            }
        },
        "filter": {
            "term": {
                "field_1": "one"
            }
        }
    }
}
JSON
				, [], function (BoolQuery $query) {
					$query->filter
						->term("field_1", "one");
					$query->must->bool->filter
						->term("field_2", "two");
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new BoolQuery;
	}
}
