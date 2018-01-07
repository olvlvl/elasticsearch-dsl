<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

use olvlvl\ElasticsearchDSL\Query\Helpers\JsonSerializeAsSimpleOrExtended;
use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

class MatchNoneQuery extends QueryAbstract
{
	use JsonSerializeAsSimpleOrExtended;

	const NAME = 'match_none';

	const OPTIONS = [
	];

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ self::NAME => (object) [] ];
	}
}
