<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class FilterQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "filter": [
        {
            "term": {
                "field1": "value1"
            }
        },
        {
            "term": {
                "field2": "value2"
            }
        },
        {
            "terms": {
                "field3": [
                    "value31",
                    "value32"
                ]
            }
        },
        {
            "terms": {
                "field4": [
                    "value41",
                    "value42"
                ]
            }
        }
    ]
}
JSON
				, [],
				function (FilterQuery $query) {
					$query->term('field1', 'value1')
						->term('field2', 'value2')
						->terms('field3', [ 'value31','value32' ])
						->terms('field4', [ 'value41','value42' ]);
				}
			],

			[
				<<<JSON
{
    "filter": [
        {
            "bool": {
                "should": [
                    {
                        "term": {
                            "field1": "value1"
                        }
                    },
                    {
                        "term": {
                            "field2": "value2"
                        }
                    }
                ]
            }
        },
        {
            "bool": {
                "must": {
                    "term": {
                        "field3": "value3"
                    }
                }
            }
        }
    ]
}
JSON
				, [],
				function (FilterQuery $query) {
					$query->bool()->should
						->term("field1", "value1")
						->term("field2", "value2");
					$query->bool()->must
						->term("field3", "value3");
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new FilterQuery;
	}
}
