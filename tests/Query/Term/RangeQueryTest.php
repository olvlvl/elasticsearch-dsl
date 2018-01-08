<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\TestCase;

class RangeQueryTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
{
    "range": {
        "field1": {
            "from": 10,
            "to": 20
        }
    }
}
JSON
				, [ 'field1' ],
				function (RangeQuery $query) {
					$query->from(10)->to(20);
				}
			],

			[
				<<<JSON
{
    "range": {
        "field1": {
            "gte": 10
        }
    }
}
JSON
				, [ 'field1' ],
				function (RangeQuery $query) {
					$query->gte(10);
				}
			],

			[
				<<<JSON
{
    "range": {
        "field1": {
            "gt": 10
        }
    }
}
JSON
				, [ 'field1' ],
				function (RangeQuery $query) {
					$query->gt(10);
				}
			],

			[
				<<<JSON
{
    "range": {
        "field1": {
            "lte": 10
        }
    }
}
JSON
				, [ 'field1' ],
				function (RangeQuery $query) {
					$query->lte(10);
				}
			],

			[
				<<<JSON
{
    "range": {
        "field1": {
            "lt": 10
        }
    }
}
JSON
				, [ 'field1' ],
				function (RangeQuery $query) {
					$query->lt(10);
				}
			],

			[
				<<<JSON
{
    "range": {
        "field1": {
            "boost": 10
        }
    }
}
JSON
				, [ 'field1' ],
				function (RangeQuery $query) {
					$query->boost(10);
				}
			],

			[
				<<<JSON
{
    "range": {
        "born": {
            "gte": "01\/01\/2012",
            "lte": "2013",
            "format": "dd\/MM\/yyyy||yyyy"
        }
    }
}
JSON
				, [ 'born' ],
				function (RangeQuery $query) {
					$query->gte("01/01/2012")->lte("2013")->format("dd/MM/yyyy||yyyy");
				}
			],

			[
				<<<JSON
{
    "range": {
        "born": {
            "gte": 1,
            "gt": 2,
            "lte": 3,
            "lt": 4,
            "boost": 1.2
        }
    }
}
JSON
				, [ 'born' ],
				function (RangeQuery $query) {
					$query->gte(1)->gt(2)->lte(3)->lt(4)->boost(1.2);
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new RangeQuery(...$args);
	}
}
