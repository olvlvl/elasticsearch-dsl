<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

class MatchPhrasePrefixQuery extends MatchPhraseQuery
{
	const NAME = 'match_phrase_prefix';
	private const OPTION_MAX_EXPANSIONS = 'max_expansions';

	public function max_expansions(?int $max_expansions)
	{
		$this->options[self::OPTION_MAX_EXPANSIONS] = $max_expansions;

		return $this;
	}
}
