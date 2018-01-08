<?php

namespace olvlvl\ElasticsearchDSL\Query\Option;

trait BoostOption
{
	public function boost(?float $boost)
	{
		$this->options[__FUNCTION__] = $boost;

		return $this;
	}
}
