<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery;

use olvlvl\ElasticsearchDSL\Query\QueryCollection;

class MustQuery extends QueryCollection
{
	const NAME = 'must';

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ self::NAME => parent::jsonSerialize() ];
	}
}
