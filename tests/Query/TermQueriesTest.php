<?php

namespace olvlvl\ElasticsearchDSL\Query;

use olvlvl\ElasticsearchDSL\Query\Term\FuzzyQuery;
use olvlvl\ElasticsearchDSL\Query\Term\IdsQuery;
use olvlvl\ElasticsearchDSL\Query\Term\PrefixQuery;
use olvlvl\ElasticsearchDSL\Query\Term\RegexpQuery;
use olvlvl\ElasticsearchDSL\Query\Term\WildcardQuery;
use PHPUnit\Framework\TestCase;

class TermQueriesTest extends TestCase
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

			[ function (HasTermQueries $query) {

				$query->term($field = uniqid(), $value = uniqid());

				return [

					[ 'term' => [ $field => $value ] ]

				];

			} ],

			[ function (HasTermQueries $query) {

				$query->term('field1', 'value1')
					->term('field2', 'value2');

				return  [

					[ 'term' => [ 'field1' => 'value1' ] ],
					[ 'term' => [ 'field2' => 'value2' ] ],

				];

			} ],

			[ function (HasTermQueries $query) {

				$query->terms($field = uniqid(), $values = [ uniqid(), uniqid() ]);

				return  [

					[ 'terms' => [ $field => $values ] ],

				];

			} ],

			[ function (HasTermQueries $query) {

				$query->terms('field1', $values1 = [ uniqid(), uniqid() ])
					->terms('field2', $values2 = [ uniqid(), uniqid() ]);

				return  [

					[ 'terms' => [ 'field1' => $values1 ] ],
					[ 'terms' => [ 'field2' => $values2 ] ],

				];

			} ],

			[ function (HasTermQueries $query) {

				$query->exists($field = uniqid());

				return  [

					[ 'exists' => [ 'field' => $field ] ],

				];

			} ],

			[ function (HasTermQueries $query) {

				$query->exists('field1')
					->exists('field2');

				return  [

					[ 'exists' => [ 'field' => 'field1' ] ],
					[ 'exists' => [ 'field' => 'field2' ] ],

				];

			} ],

			[ function (HasTermQueries $query) {

				$query->prefix($field = uniqid(), $value = uniqid());

				return  [

					[ 'prefix' => [ $field => $value ] ],

				];

			} ],

			[ function (HasTermQueries $query) {

				$query->prefix('field1', 'value1')
					->prefix('field2', 'value2', function (PrefixQuery $query) {
						$query->boost(1.5);
					});

				return  [

					[ 'prefix' => [ 'field1' => 'value1' ] ],
					[ 'prefix' => [ 'field2' => [ 'value' => 'value2', 'boost' => 1.5 ] ] ],

				];

			} ],

			[ function (HasTermQueries $query) {

				$query->wildcard($field = uniqid(), $value = uniqid());

				return  [

					[ 'wildcard' => [ $field => $value ] ],

				];

			} ],

			[ function (HasTermQueries $query) {

				$query->wildcard('field1', 'value1')
					->wildcard('field2', 'value2', function (WildcardQuery $query) {
						$query->boost(1.5);
					});

				return  [

					[ 'wildcard' => [ 'field1' => 'value1' ] ],
					[ 'wildcard' => [ 'field2' => [ 'value' => 'value2', 'boost' => 1.5 ] ] ],

				];

			} ],

			[ function (HasTermQueries $query) {

				$query->regexp($field = uniqid(), $value = uniqid());

				return  [

					[ 'regexp' => [ $field => $value ] ],

				];

			} ],

			[ function (HasTermQueries $query) {

				$query->regexp('field1', 'value1')
					->regexp('field2', 'value2', function (RegexpQuery $query) {
						$query
							->boost(1.2)
							->flags('my_flags')
							->max_determinized_states(32);
					});

				return  [

					[ 'regexp' => [ 'field1' => 'value1' ] ],
					[ 'regexp' => [ 'field2' => [
						'value' => 'value2',
						'boost' => 1.2,
						'flags' => 'my_flags',
						'max_determinized_states' => 32,
					] ] ],

				];

			} ],

			[ function (HasTermQueries $query) {

				$query->fuzzy($field = uniqid(), $value = uniqid());

				return  [

					[ 'fuzzy' => [ $field => $value ] ],

				];

			} ],

			[ function (HasTermQueries $query) {

				$query->fuzzy('field1', 'value1')
					->fuzzy('field2', 'value2', function (FuzzyQuery $query) {
						$query
							->boost(1.7)
							->fuzziness(12)
							->prefix_length(3)
							->max_expansions(32);
					});

				return  [

					[ 'fuzzy' => [ 'field1' => 'value1' ] ],
					[ 'fuzzy' => [ 'field2' => [
						'value' => 'value2',
						'boost' => 1.7,
						'fuzziness' => 12,
						'prefix_length' => 3,
						'max_expansions' => 32
					] ] ],

				];

			} ],

			[ function (HasTermQueries $query) {

				$query->type($type = uniqid());

				return  [

					[ 'type' => [ 'value' => $type ] ],

				];

			} ],

			[ function (HasTermQueries $query) {

				$query->type($type1 = uniqid())
					->type($type2 = uniqid());

				return  [

					[ 'type' => [ 'value' => $type1 ] ],
					[ 'type' => [ 'value' => $type2 ] ],

				];

			} ],

			[ function (HasTermQueries $query) {

				$query->ids($ids = [ uniqid(), uniqid() ]);

				return  [

					[ 'ids' => [ 'values' => $ids ] ],

				];

			} ],

			[ function (HasTermQueries $query) {

				$query->ids($ids1 = [ uniqid(), uniqid() ])
					->ids($ids2 = [ uniqid(), uniqid() ], function (IdsQuery $query) {
						$query->type('my_type');
					});

				return  [

					[ 'ids' => [ 'values' => $ids1 ] ],
					[ 'ids' => [ 'values' => $ids2, 'type' => 'my_type' ] ],

				];

			} ],

		];
	}

	private function makeInstance()
	{
		return new class() implements \JsonSerializable, HasTermQueries
		{
			use TermQueries {
				jsonSerializeTermQueries as public jsonSerialize;
			}
		};
	}
}
