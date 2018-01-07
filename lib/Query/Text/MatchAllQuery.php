<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

use olvlvl\ElasticsearchDSL\Query\Option\BoostOption;
use olvlvl\ElasticsearchDSL\Query\Option\HasBoostOption;
use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

class MatchAllQuery extends QueryAbstract implements HasBoostOption
{
	use BoostOption;

	const NAME = 'match_all';

	const OPTIONS = [

		self::OPTION_BOOST,

	];

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ self::NAME => parent::jsonSerialize() ?: (object) [] ];
	}
}
