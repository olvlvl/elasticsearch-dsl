<?php

namespace olvlvl\ElasticsearchDSL\Query;

use olvlvl\ElasticsearchDSL\Query\Text\MatchPhrasePrefixQuery;
use olvlvl\ElasticsearchDSL\Query\Text\MatchPhraseQuery;
use olvlvl\ElasticsearchDSL\Query\Text\MatchQuery;
use olvlvl\ElasticsearchDSL\Query\Text\MultiMatchQuery;
use PHPUnit\Framework\TestCase;

class TextQueriesTest extends TestCase
{
	/**
	 * @dataProvider provideSerialization
	 *
	 * @param callable $init
	 */
	public function testSerialization(callable $init)
	{
		$instance = $this->makeInstance();
		$expected = $init($instance);

		$this->assertSame($expected, json_decode(json_encode($instance), true));
	}

	public function provideSerialization(): array
	{
		return [

			[ function (HasTextQueries $query) {

				$query->match($field = uniqid(), $q = uniqid());

				return [

					[ 'match' => [ $field => $q ] ]

				];

			} ],

			[ function (HasTextQueries $query) {

				$query->match($field1 = uniqid(), $query1 = uniqid())
					->match($field2 = uniqid(), $query2 = uniqid(), $options = [
						MatchQuery::OPTION_OPERATOR => 'and',
						MatchQuery::OPTION_ZERO_TERMS_QUERY => 'all',
						MatchQuery::OPTION_CUTOFF_FREQUENCY => .5,
						MatchQuery::OPTION_FUZZINESS => 'AUTO',
					]);

				return [

					[ 'match' => [ $field1 => $query1 ] ],
					[ 'match' => [ $field2 => [ 'query' => $query2 ] + $options ] ],

				];

			} ],

			[ function (HasTextQueries $query) {

				$query->match_phrase($field = uniqid(), $q = uniqid());

				return [

					[ 'match_phrase' => [ $field => $q ] ],

				];

			} ],

			[ function (HasTextQueries $query) {

				$query->match_phrase($field1 = uniqid(), $query1 = uniqid())
					->match_phrase($field2 = uniqid(), $query2 = uniqid(), $options = [
						MatchPhraseQuery::OPTION_ANALYZER => uniqid(),
					]);

				return [

					[ 'match_phrase' => [ $field1 => $query1 ] ],
					[ 'match_phrase' => [ $field2 => [ 'query' => $query2 ] + $options ] ],

				];

			} ],

			[ function (HasTextQueries $query) {

				$query->match_phrase_prefix($field = uniqid(), $q = uniqid());

				return [

					[ 'match_phrase_prefix' => [ $field => $q ] ],

				];

			} ],

			[ function (HasTextQueries $query) {

				$query->match_phrase_prefix($field1 = uniqid(), $query1 = uniqid())
					->match_phrase_prefix($field2 = uniqid(), $query2 = uniqid(), $options = [
						MatchPhrasePrefixQuery::OPTION_ANALYZER => uniqid(),
						MatchPhrasePrefixQuery::OPTION_MAX_EXPANSIONS => mt_rand(10, 20),
					]);

				return [

					[ 'match_phrase_prefix' => [ $field1 => $query1 ] ],
					[ 'match_phrase_prefix' => [ $field2 => [ 'query' => $query2 ] + $options ] ],

				];

			} ],

			[ function (HasTextQueries $query) {

				$query->multi_match($fields1 = [ uniqid(), uniqid() ], $query1 = uniqid());

				return [

					[ 'multi_match' => [ 'query' => $query1, 'fields' => $fields1 ] ],

				];

			} ],

			[ function (HasTextQueries $query) {

				$query->multi_match($fields1 = [ uniqid(), uniqid() ], $query1 = uniqid())
					->multi_match($fields2 = [ uniqid(), uniqid() ], $query2 = uniqid(), $options = [
						MultiMatchQuery::OPTION_OPERATOR => 'and',
						MultiMatchQuery::OPTION_TYPE => 'best_fields',
						MultiMatchQuery::OPTION_TIE_BREAKER => .3,
					]);

				return [

					[ 'multi_match' => [ 'query' => $query1, 'fields' => $fields1 ] ],
					[ 'multi_match' => [ 'query' => $query2, 'fields' => $fields2 ] + $options ],

				];

			} ],

		];
	}

	private function makeInstance()
	{
		return new class() implements \JsonSerializable, HasTextQueries
		{
			use TextQueries {
				jsonSerializeTextQueries as public jsonSerialize;
			}
		};
	}
}
