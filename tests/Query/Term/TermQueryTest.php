<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

class TermQueryTest extends TestCase
{
	public function getQueryClass(): string
	{
		return TermQuery::class;
	}

	public function provideSerialization(): array
	{
		return [

			[
				[ $term = uniqid(), $value = uniqid() ],
				[ $term => $value ],
			],

			[
				[ $term = uniqid(), $value = uniqid(), [ TermQuery::OPTION_BOOST => $boost = mt_rand(1, 10) + .5 ] ],
				[ $term => $value, 'boost' => $boost ],
			],

		];
	}
}
