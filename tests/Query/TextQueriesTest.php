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

				$query->match('field1', 'query1')
					->match('field2', 'query2', function(MatchQuery $match) {
						$match
							->operator('and')
							->zero_terms_query('all')
							->cutoff_frequency(.5)
							->fuzziness('AUTO');
					});

				return [

					[ 'match' => [ 'field1' => 'query1' ] ],
					[ 'match' => [ 'field2' => [ 'query' => 'query2' ] + [
						'operator' => 'and',
						'zero_terms_query' => 'all',
						'cutoff_frequency' => .5,
						'fuzziness' => 'AUTO',
					] ] ],

				];

			} ],

			[ function (HasTextQueries $query) {

				$query->match_phrase($field = uniqid(), $q = uniqid());

				return [

					[ 'match_phrase' => [ $field => $q ] ],

				];

			} ],

			[ function (HasTextQueries $query) {

				$query->match_phrase('field1', 'query1')
					->match_phrase('field2', 'query2', function (MatchPhraseQuery $match_phrase) {
						$match_phrase->analyzer('my_analyser');
					});

				return [

					[ 'match_phrase' => [ 'field1' => 'query1' ] ],
					[ 'match_phrase' => [ 'field2' => [
						'query' => 'query2',
						'analyzer' => 'my_analyser',
					] ] ],

				];

			} ],

			[ function (HasTextQueries $query) {

				$query->match_phrase_prefix($field = uniqid(), $q = uniqid());

				return [

					[ 'match_phrase_prefix' => [ $field => $q ] ],

				];

			} ],

			[ function (HasTextQueries $query) {

				$query->match_phrase_prefix('field1', 'query1')
					->match_phrase_prefix(
						'field2',
						'query2',
						function (MatchPhrasePrefixQuery $query) {
							$query
								->analyzer('my_analyser')
								->max_expansions(10);
						}
					);

				return [

					[ 'match_phrase_prefix' => [ 'field1' => 'query1' ] ],
					[ 'match_phrase_prefix' => [ 'field2' => [ 'query' => 'query2',
						'analyzer' => 'my_analyser',
						'max_expansions' => 10,
					] ] ],

				];

			} ],

			[ function (HasTextQueries $query) {

				$query->multi_match([ 'fields1', 'fields2' ], 'query1');

				return [

					[ 'multi_match' => [ 'query' => 'query1', 'fields' => [ 'fields1', 'fields2' ] ] ],

				];

			} ],

			[ function (HasTextQueries $query) {

				$query->multi_match([ 'fields1', 'fields2' ], 'query1')
					->multi_match(
						[ 'fields3', 'fields4' ],
						'query2',
						function (MultiMatchQuery $q) {
							$q
								->operator('and')
								->type('best_fields')
								->tie_breaker(.3);
						}
					);

				return [

					[ 'multi_match' => [ 'query' => 'query1', 'fields' => [ 'fields1', 'fields2' ] ] ],
					[ 'multi_match' => [
						'query' => 'query2',
						'fields' => [ 'fields3', 'fields4' ],
						'operator' => 'and',
						'type' => 'best_fields',
						'tie_breaker' => .3
					] ],

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
