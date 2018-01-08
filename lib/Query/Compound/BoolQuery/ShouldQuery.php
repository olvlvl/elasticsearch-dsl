<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery;

use olvlvl\ElasticsearchDSL\Query\QueryCollection;

class ShouldQuery extends QueryCollection
{
	const NAME = 'should';

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ self::NAME => parent::jsonSerialize() ];
	}
}
