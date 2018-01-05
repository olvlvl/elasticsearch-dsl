<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery;

use PHPUnit\Framework\TestCase;

class FilterQueryTest extends TestCase
{
	public function testOne90()
	{
		$filter = (new FilterQuery)
			->term($field1 = uniqid(), $value1 = uniqid())
			->term($field2 = uniqid(), $value2 = uniqid())
			->terms($field3 = uniqid(), $value3 = [ uniqid(), uniqid() ])
			->terms($field4 = uniqid(), $value4 = [ uniqid(), uniqid() ])
		;

		$this->assertSame([

			[ 'term' => [ $field1 => $value1 ] ],
			[ 'term' => [ $field2 => $value2 ] ],
			[ 'terms' => [ $field3 => $value3 ] ],
			[ 'terms' => [ $field4 => $value4 ] ],

		], json_decode(json_encode($filter), true));
	}
}
