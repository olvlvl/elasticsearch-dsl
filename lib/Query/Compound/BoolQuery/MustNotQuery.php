<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery;

use olvlvl\ElasticsearchDSL\Query\QueryCollection;

class MustNotQuery extends QueryCollection
{
	const NAME = 'must_not';

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ self::NAME => parent::jsonSerialize() ];
	}
}
