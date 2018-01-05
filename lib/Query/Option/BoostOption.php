<?php

namespace olvlvl\ElasticsearchDSL\Query\Option;

trait BoostOption
{
	public function boost(?float $boost)
	{
		$this->options[self::OPTION_BOOST] = $boost;

		return $this;
	}
}
