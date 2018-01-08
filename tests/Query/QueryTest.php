<?php

namespace olvlvl\ElasticsearchDSL\Query;

use olvlvl\ElasticsearchDSL\Query;

class QueryTest extends QueryTestCase
{
	public function provideSerialization(): array
	{
		return [

			[ function (Query $query) {
				$query->match_all();

				return <<<JSON
{
    "query": {
        "match_all": {}
    }
}
JSON;

			} ],

			[ function (Query $query) {
				$query->match_none();

				return <<<JSON
{
    "query": {
        "match_none": {}
    }
}
JSON;

			} ],

			[ function (Query $query) {
				$query->bool->must
					->match('title', "Search")
					->match('content', "Elasticsearch");
				$query->bool->filter
					->term('status', 'published')
					->range('publish_date', function (Query\Term\RangeQuery $range) {
						$range->gte("2015-01-01");
					});

				return <<<JSON
{
    "query": {
        "bool": {
            "must": [
                {
                    "match": {
                        "title": "Search"
                    }
                },
                {
                    "match": {
                        "content": "Elasticsearch"
                    }
                }
            ],
            "filter": [
                {
                    "term": {
                        "status": "published"
                    }
                },
                {
                    "range": {
                        "publish_date": {
                            "gte": "2015-01-01"
                        }
                    }
                }
            ]
        }
    }
}
JSON;

			} ],

			[ function (Query $query) {
				$query->bool->must
					->match("preference_1", "Apples");

				return <<<EOT
{
    "query": {
        "bool": {
            "must": {
                "match": {
                    "preference_1": "Apples"
                }
            }
        }
    }
}
EOT;
			} ],

			[ function (Query $query) {
				$query->bool->must
					->match("preference_1", "Apples")
					->match("preference_2", "Bananas");

				return <<<EOT
{
    "query": {
        "bool": {
            "must": [
                {
                    "match": {
                        "preference_1": "Apples"
                    }
                },
                {
                    "match": {
                        "preference_2": "Bananas"
                    }
                }
            ]
        }
    }
}
EOT;
			} ],

			[ function (Query $query) {
				$query->bool->must_not
					->match("preference_1", "Apples");

				return <<<EOT
{
    "query": {
        "bool": {
            "must_not": {
                "match": {
                    "preference_1": "Apples"
                }
            }
        }
    }
}
EOT;

			} ],

			[ function (Query $query) {
				$query->bool->should
					->match("preference_1", "Apples")
					->match("preference_2", "Bananas");

				return <<<EOT
{
    "query": {
        "bool": {
            "should": [
                {
                    "match": {
                        "preference_1": "Apples"
                    }
                },
                {
                    "match": {
                        "preference_2": "Bananas"
                    }
                }
            ]
        }
    }
}
EOT;
			} ],

			[ function (Query $query) {
				$query->bool->should->bool()->must
					->match("preference_1", "Apples")
					->match("preference_2", "Bananas");

				$query->bool->should->bool()->must
					->match("preference_1", "Apples")
					->match("preference_2", "Bananas");

				$query->bool->should->match("preference_1", "Grapefruit");

				return <<<EOT
{
    "query": {
        "bool": {
            "should": [
                {
                    "bool": {
                        "must": [
                            {
                                "match": {
                                    "preference_1": "Apples"
                                }
                            },
                            {
                                "match": {
                                    "preference_2": "Bananas"
                                }
                            }
                        ]
                    }
                },
                {
                    "bool": {
                        "must": [
                            {
                                "match": {
                                    "preference_1": "Apples"
                                }
                            },
                            {
                                "match": {
                                    "preference_2": "Bananas"
                                }
                            }
                        ]
                    }
                },
                {
                    "match": {
                        "preference_1": "Grapefruit"
                    }
                }
            ]
        }
    }
}
EOT;

			} ],

			[ function (Query $query) {
				$query->bool->should->bool()->must
					->match("preference_1", "Apples")
					->match("preference_2", "Bananas");
				$query->bool->should->bool()->must
					->match("preference_1", "Apples")
					->match("preference_2", "Cherries");
				$query->bool->should->match("preference_1", "Grapefruit");
				$query->bool->filter->term("grade", "2");

				return <<<JSON
{
    "query": {
        "bool": {
            "filter": {
                "term": {
                    "grade": "2"
                }
            },
            "should": [
                {
                    "bool": {
                        "must": [
                            {
                                "match": {
                                    "preference_1": "Apples"
                                }
                            },
                            {
                                "match": {
                                    "preference_2": "Bananas"
                                }
                            }
                        ]
                    }
                },
                {
                    "bool": {
                        "must": [
                            {
                                "match": {
                                    "preference_1": "Apples"
                                }
                            },
                            {
                                "match": {
                                    "preference_2": "Cherries"
                                }
                            }
                        ]
                    }
                },
                {
                    "match": {
                        "preference_1": "Grapefruit"
                    }
                }
            ]
        }
    }
}
JSON;

			} ],

			[ function (Query $query) {
				$query->bool->must
					->term("user", "kimchy");
				$query->bool->must_not
					->range("age", function (Query\Term\RangeQuery $range) {
						$range->from(10)->to(10);
					});
				$query->bool->should
					->term("tag", "wow")
					->term("tag", "elasticsearch");
				$query->bool
					->minimum_should_match(1)
					->boost(1.5);

				return <<<JSON
{
    "query": {
        "bool": {
            "must": {
                "term": {
                    "user": "kimchy"
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
                        "from": 10,
                        "to": 10
                    }
                }
            },
            "minimum_should_match": 1,
            "boost": 1.5
        }
    }
}
JSON;

			} ],

			[ function (Query $query) {
				$query->nested("menus")
					->score_mode('avg')
					->ignore_unmapped(true)
					->query->bool->filter
						->term("menus.week", "2018-W03")
						->term("menus.product", "express-box");

				return <<<JSON
{
    "query": {
        "nested": {
            "path": "menus",
            "score_mode": "avg",
            "ignore_unmapped": true,
            "query": {
                "bool": {
                    "filter": [
                        {
                            "term": {
                                "menus.week": "2018-W03"
                            }
                        },
                        {
                            "term": {
                                "menus.product": "express-box"
                            }
                        }
                    ]
                }
            }
        }
    }
}
JSON;
			} ],

			[ function (Query $query) {
				$query->constant_score(1.2)->filter->term("user", "kimchy");

				return <<<JSON
{
    "query": {
        "constant_score": {
            "filter": {
                "term": {
                    "user": "kimchy"
                }
            },
            "boost": 1.2
        }
    }
}
JSON;
			} ],

			[ function (Query $query) {
				$query->boosting(.2)->positive->term("field1", "value1");
				$query->boosting->negative->term("field2", "value2");

				return <<<JSON
{
    "query": {
        "boosting": {
            "positive": {
                "term": {
                    "field1": "value1"
                }
            },
            "negative": {
                "term": {
                    "field2": "value2"
                }
            },
            "negative_boost": 0.2
        }
    }
}
JSON;
			} ],

			[ function (Query $query) {
				$query->dis_max->tie_breaker(0.7)->boost(1.2);
				$query->dis_max->queries->term("age", 34);
				$query->dis_max->queries->term("age", 35);

				return <<<JSON
{
    "query": {
        "dis_max": {
            "tie_breaker": 0.7,
            "boost": 1.2,
            "queries": [
                {
                    "term": {
                        "age": 34
                    }
                },
                {
                    "term": {
                        "age": 35
                    }
                }
            ]
        }
    }
}
JSON;

			} ],

		];
	}

	protected function makeInstance()
	{
		return new Query();
	}
}
