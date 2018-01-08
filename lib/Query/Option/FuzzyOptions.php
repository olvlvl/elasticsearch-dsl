<?php

namespace olvlvl\ElasticsearchDSL\Query\Option;

trait FuzzyOptions
{
	public function fuzziness($fuzziness = null)
	{
		$this->options[__FUNCTION__] = $fuzziness;

		return $this;
	}

	public function prefix_length(?int $prefix_length)
	{
		$this->options[__FUNCTION__] = $prefix_length;

		return $this;
	}

	public function max_expansions(?int $max_expansions)
	{
		$this->options[__FUNCTION__] = $max_expansions;

		return $this;
	}
}
