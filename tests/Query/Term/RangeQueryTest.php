<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

class RangeQueryTest extends TestCase
{
	public function getQueryClass(): string
	{
		return RangeQuery::class;
	}

	public function provideSerialization(): array
	{
		return [

			[
				[
					$field = uniqid(), [
						RangeQuery::OPTION_FROM => $from = uniqid(),
						RangeQuery::OPTION_TO => $to = uniqid(),
					]
				],
				[
					$field => [
						'from' => $from,
						'to' => $to,
					]
				],
			],

			[
				[
					$field = uniqid(), [
						RangeQuery::OPTION_GTE => $gte = uniqid()
					]
				],
				[
					$field => [
						'gte' => $gte
					]
				],
			],

			[
				[
					$field = uniqid(), [
						RangeQuery::OPTION_GT => $gt = uniqid()
					]
				],
				[
					$field => [
						'gt' => $gt
					]
				],
			],

			[
				[
					$field = uniqid(), [
						RangeQuery::OPTION_LTE => $lte = uniqid()
					]
				],
				[
					$field => [
						'lte' => $lte
					]
				],
			],

			[
				[
					$field = uniqid(), [
						RangeQuery::OPTION_LT => $lt = uniqid()
					]
				],
				[
					$field => [
						'lt' => $lt
					]
				],
			],

			[
				[
					$field = uniqid(), [
						RangeQuery::OPTION_BOOST => $boost = mt_rand(10, 20) + .5
					]
				],
				[
					$field => [
						'boost' => $boost
					]
				],
			],

			[
				[
					$field = uniqid(), [
						RangeQuery::OPTION_GTE => $gte,
						RangeQuery::OPTION_GT => $gt,
						RangeQuery::OPTION_LTE => $lte,
						RangeQuery::OPTION_LT => $lt,
						RangeQuery::OPTION_BOOST => $boost,
					]
				],
				[
					$field => [
						'gte' => $gte,
						'gt' => $gt,
						'lte' => $lte,
						'lt' => $lt,
						'boost' => $boost
					]
				],
			],

		];
	}
}
