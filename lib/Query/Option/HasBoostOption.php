<?php

namespace olvlvl\ElasticsearchDSL\Query\Option;

interface HasBoostOption
{
	/**
	 * @param float|null $boost
	 *
	 * @return $this
	 */
	public function boost(?float $boost);
}
