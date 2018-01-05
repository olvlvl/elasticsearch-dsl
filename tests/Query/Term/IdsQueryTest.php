<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

class IdsQueryTest extends TestCase
{
	public function getQueryClass(): string
	{
		return IdsQuery::class;
	}

	public function provideSerialization(): array
	{
		return [

			[
				[ $values = [ uniqid(), uniqid() ] ],
				[ 'values' => $values ],
			],

			[
				[ $values = [ uniqid(), uniqid() ], [ IdsQuery::OPTION_TYPE => $type = uniqid() ] ],
				[ 'values' => $values, 'type' => $type ],
			],

		];
	}
}
