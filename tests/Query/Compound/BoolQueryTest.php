<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound;

use olvlvl\ElasticsearchDSL\Query\QueryTestCase;

class BoolQueryTest extends QueryTestCase
{
	public function provideSerialization(): array
	{
		return [

			[ function (BoolQuery $query) {
				$query->must
					->term("preference_1", "Apples");

				return <<<JSON
{
    "bool": {
        "must": {
            "term": {
                "preference_1": "Apples"
            }
        }
    }
}
JSON;
			} ],

			[ function (BoolQuery $query) {
				$query->must
					->term("preference_1", "Apples")
					->term("preference_2", "Banana");

				return <<<JSON
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
JSON;
			} ],

			[ function (BoolQuery $query) {
				$query->must
					->term("preference_1", "Apples")
					->term("preference_2", "Banana")
					->terms("preference_3", [ "One", "Two" ]);

				return <<<JSON
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
JSON;
			} ],

			[ function (BoolQuery $query) {
				$query->must
					->term("preference_1", "Apples")
					->term("preference_2", "Banana")
					->terms("preference_3", [ "One", "Two" ]);
				$query->filter
					->term("preference_4", "Orange");
				$query->should
					->match("field_1", "Kiwi");

				return <<<JSON
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
JSON;
			} ],

			[ function (BoolQuery $query) {
				$query->filter
					->term("field_1", "one");
				$query->must->bool->filter
					->term("field_2", "two");

				return <<<JSON
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
JSON;
			} ],

		];
	}

	protected function makeInstance()
	{
		return new BoolQuery;
	}
}
