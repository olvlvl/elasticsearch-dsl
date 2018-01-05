<?php

namespace olvlvl\ElasticsearchDSL\Query\Option;

/**
 * @property float|null $boost
 */
interface HasBoostOption
{
	const OPTION_BOOST = 'boost';

	/**
	 * @param float|null $boost
	 *
	 * @return $this
	 */
	public function boost(?float $boost);
}
