<?php

namespace olvlvl\ElasticsearchDSL\Query\Joining;

use olvlvl\ElasticsearchDSL\Query\Term\RangeQuery;
use olvlvl\ElasticsearchDSL\Query\TestCase;

class NestedQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				[
					'obj1'
				],
				function (NestedQuery $query) {
					$query->score_mode('avg')
						->query->bool->must
						->match('obj1.name', "blue")
						->range('obj1.count', function (RangeQuery $range) {
							$range->gt(5);
						});
					return <<<JSON
{
    "nested": {
        "path": "obj1",
        "score_mode": "avg",
        "query": {
            "bool": {
                "must": [
                    {
                        "match": {
                            "obj1.name": "blue"
                        }
                    },
                    {
                        "range": {
                            "obj1.count": {
                                "gt": 5
                            }
                        }
                    }
                ]
            }
        }
    }
}
JSON;
				}
			]

		];
	}

	protected function makeInstance(array $args)
	{
		return new NestedQuery(...$args);
	}
}
