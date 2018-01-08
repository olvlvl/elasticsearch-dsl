<?php

namespace olvlvl\ElasticsearchDSL\Query;

use ICanBoogie\Accessor\AccessorTrait;
use olvlvl\ElasticsearchDSL\Query\Compound\BoostingQuery;
use olvlvl\ElasticsearchDSL\Query\Compound\ConstantScoreQuery;
use olvlvl\ElasticsearchDSL\Query\Compound\DisMaxQuery;

class CompoundQueriesTest extends TestCase
{
	/**
	 * @dataProvider provideGetters
	 *
	 * @param string $type
	 * @param string $name
	 */
	public function testGetters(string $type, string $name)
	{
		$query = $this->makeInstance([]);

		$this->assertInstanceOf($type, $expected = $query->$name);
		$this->assertSame($expected, $query->$name);
		$this->assertNotSame($expected, $query->$name());
	}

	public function provideGetters(): array
	{
		return [

			[ BoostingQuery::class, 'boosting' ],
			[ ConstantScoreQuery::class, 'constant_score' ],
			[ DisMaxQuery::class, 'dis_max' ],

		];
	}

	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
[
    {
        "constant_score": {
            "must": {
                "term": {
                    "field1": "value1"
                }
            },
            "boost": 1.7
        }
    }
]
JSON
				, [],
				function (HasCompoundQueries $query) {
					$query->constant_score(1.7)
						->must->term('field1', 'value1');
				}
			],

			[
				<<<JSON
[
    {
        "dis_max": {
            "tie_breaker": 1.3,
            "boost": 1.2,
            "queries": {
                "term": {
                    "field1": "value1"
                }
            }
        }
    }
]
JSON
				, [],
				function (HasCompoundQueries $query) {
					$query->dis_max(function (DisMaxQuery $dis_max) {
						$dis_max->boost(1.2)->tie_breaker(1.3);
					})->queries->term('field1', 'value1');
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new class() implements \JsonSerializable, HasCompoundQueries
		{
			use AccessorTrait;
			use CompoundQueries {
				jsonSerializeCompoundQueries as public jsonSerialize;
			}

			public function __toString()
			{
				return json_encode($this, JSON_PRETTY_PRINT);
			}
		};
	}
}
