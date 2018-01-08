<?php

namespace olvlvl\ElasticsearchDSL;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class QueryTest extends TestCase
{
	public function testToArray()
	{
		$this->assertEquals([ 'query' => (object) [] ], (new Query)->to_array());
	}

	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "query": {}
}
JSON
			],

			[
				<<<JSON
{
    "query": {
        "match_all": {}
    }
}
JSON
				,
				[],
				function (Query $query) {
					$query->match_all();
				}
			],

			[
				<<<JSON
{
    "query": {
        "match_none": {}
    }
}
JSON
			, [],
			function (Query $query) {
				$query->match_none();
				}
			],

			[
				<<<JSON
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
JSON
			, [],
			function (Query $query) {
				$query->bool->must
					->match('title', "Search")
					->match('content', "Elasticsearch");
				$query->bool->filter
					->term('status', 'published')
					->range('publish_date', function (Query\Term\RangeQuery $range) {
						$range->gte("2015-01-01");
					});
				}
			],

			[
				<<<JSON
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
JSON
				, [],
				function (Query $query) {
					$query->bool->must
						->match("preference_1", "Apples");
				}
			],

			[
				<<<JSON
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
JSON
				, [],
				function (Query $query) {
					$query->bool->must
						->match("preference_1", "Apples")
						->match("preference_2", "Bananas");
				}
			],

			[
				<<<JSON
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
JSON
				, [],
				function (Query $query) {
					$query->bool->must_not
						->match("preference_1", "Apples");
				}
			],

			[
				<<<JSON
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
JSON
				, [],
				function (Query $query) {
					$query->bool->should
						->match("preference_1", "Apples")
						->match("preference_2", "Bananas");
				}
			],

			[
				<<<JSON
{
    "query": {
        "bool": {
            "should": [
                {
                    "match": {
                        "preference_1": "Grapefruit"
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
            ]
        }
    }
}
JSON
				, [],
				function (Query $query) {
					$query->bool->should->bool()->must
						->match("preference_1", "Apples")
						->match("preference_2", "Bananas");

					$query->bool->should->bool()->must
						->match("preference_1", "Apples")
						->match("preference_2", "Bananas");

					$query->bool->should->match("preference_1", "Grapefruit");
				}
			],

			[
				<<<JSON
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
                    "match": {
                        "preference_1": "Grapefruit"
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
                }
            ]
        }
    }
}
JSON
				, [],
				function (Query $query) {
					$query->bool->should->bool()->must
						->match("preference_1", "Apples")
						->match("preference_2", "Bananas");
					$query->bool->should->bool()->must
						->match("preference_1", "Apples")
						->match("preference_2", "Cherries");
					$query->bool->should->match("preference_1", "Grapefruit");
					$query->bool->filter->term("grade", "2");
				}
			],

			[
				<<<JSON
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
JSON
				, [],
				function (Query $query) {
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
				}
			],

			[
				<<<JSON
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
JSON
				, [],
				function (Query $query) {
					$query->nested("menus")
						->score_mode('avg')
						->ignore_unmapped(true)
						->query->bool->filter
							->term("menus.week", "2018-W03")
							->term("menus.product", "express-box");
				}
			],

			[
				<<<JSON
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
JSON
				, [],
				function (Query $query) {
					$query->constant_score(1.2)->filter->term("user", "kimchy");
				}
			],

			[
				<<<JSON
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
JSON
				, [],
				function (Query $query) {
					$query->boosting(.2)->positive->term("field1", "value1");
					$query->boosting->negative->term("field2", "value2");
				}
			],

			[
				<<<JSON
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
JSON
				, [],
				function (Query $query) {
					$query->dis_max->tie_breaker(0.7)->boost(1.2);
					$query->dis_max->queries->term("age", 34);
					$query->dis_max->queries->term("age", 35);
				}
			],

			[
				<<<JSON
{
    "query": {
        "bool": {
            "must": {
                "nested": {
                    "path": "menus",
                    "query": {
                        "bool": {
                            "filter": [
                                {
                                    "term": {
                                        "menus.product": "express-box"
                                    }
                                },
                                {
                                    "term": {
                                        "menus.week": "2018-W03"
                                    }
                                }
                            ]
                        }
                    }
                }
            },
            "filter": {
                "term": {
                    "tags.slug": "under-30-minutes"
                }
            }
        }
    }
}
JSON
				, [],
				function (Query $query) {
					$query->bool->filter
						->term('tags.slug', "under-30-minutes");
					$query->bool->must->nested("menus")->query->bool->filter
						->term("menus.product", "express-box")
						->term("menus.week", "2018-W03");
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new Query;
	}
}
