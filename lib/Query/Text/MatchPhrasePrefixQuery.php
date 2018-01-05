<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

use olvlvl\ElasticsearchDSL\Query\Helpers\JsonSerializeAsSimpleOrExtended;
use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

class MatchPhrasePrefixQuery extends MatchPhraseQuery
{
	const NAME = 'match_phrase_prefix';

	const OPTION_MAX_EXPANSIONS = 'max_expansions';

	protected const OPTIONS = MatchPhraseQuery::OPTIONS + [

		self::OPTION_MAX_EXPANSIONS,

	];

	public function max_expansions(?int $max_expansions)
	{
		$this->options[self::OPTION_MAX_EXPANSIONS] = $max_expansions;

		return $this;
	}
}
