<?php

namespace olvlvl\ElasticsearchDSL\Query\Option;

trait MatchOptions
{
	use FuzzyOptions;

	public function operator(?string $operator)
	{
		$this->options[__FUNCTION__] = $operator;

		return $this;
	}

	public function zero_terms_query(?string $zero_terms_query)
	{
		$this->options[__FUNCTION__] = $zero_terms_query;

		return $this;
	}

	public function cutoff_frequency(?float $cutoff_frequency)
	{
		$this->options[__FUNCTION__] = $cutoff_frequency;

		return $this;
	}
}
