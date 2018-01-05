<?php

namespace olvlvl\ElasticsearchDSL\Query\Option;

trait MatchOptions
{
	use FuzzyOptions;

	public function operator(?string $operator)
	{
		$this->options[self::OPTION_OPERATOR] = $operator;

		return $this;
	}

	public function zero_terms_query(?string $zero_terms_query)
	{
		$this->options[self::OPTION_ZERO_TERMS_QUERY] = $zero_terms_query;

		return $this;
	}

	public function cutoff_frequency(?float $cutoff_frequency)
	{
		$this->options[self::OPTION_CUTOFF_FREQUENCY] = $cutoff_frequency;

		return $this;
	}
}
