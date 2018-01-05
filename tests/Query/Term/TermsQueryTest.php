<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

class TermsQueryTest extends TestCase
{
	public function getQueryClass(): string
	{
		return TermsQuery::class;
	}

	public function provideSerialization(): array
	{
		return [

			[
				[ $field = uniqid(), $values = [ uniqid(), uniqid() ] ],
				[ $field => $values ],
			],

			[
				[ $field = uniqid(), $options = [
					TermsQuery::OPTION_INDEX => uniqid(),
					TermsQuery::OPTION_TYPE => uniqid(),
					TermsQuery::OPTION_ID => uniqid(),
					TermsQuery::OPTION_PATH => uniqid(),
					TermsQuery::OPTION_ROUTING => uniqid()
				] ],
				[ $field => $options ],
			],

		];
	}
}
