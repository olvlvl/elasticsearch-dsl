<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

class MatchPhrasePrefixQuery extends MatchPhraseQuery
{
	const NAME = 'match_phrase_prefix';

	public function max_expansions(?int $max_expansions)
	{
		$this->options[__FUNCTION__] = $max_expansions;

		return $this;
	}
}
