<?php

namespace olvlvl\ElasticsearchDSL\Query\Option;

interface HasMatchOptions extends HasFuzzyOptions
{
	/**
	 * @param null|string $operator
	 *
	 * @return $this
	 */
	public function operator(?string $operator);

	/**
	 * @param null|string $zero_terms_query
	 *
	 * @return $this
	 */
	public function zero_terms_query(?string $zero_terms_query);

	/**
	 * @param float|null $cutoff_frequency
	 *
	 * @return $this
	 */
	public function cutoff_frequency(?float $cutoff_frequency);
}
