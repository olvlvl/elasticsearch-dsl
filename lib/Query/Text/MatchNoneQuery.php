<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

class MatchNoneQuery extends QueryAbstract
{
	const NAME = 'match_none';

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ self::NAME => (object) [] ];
	}
}
