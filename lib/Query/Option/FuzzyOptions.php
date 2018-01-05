<?php

namespace olvlvl\ElasticsearchDSL\Query\Option;

trait FuzzyOptions
{
	public function fuzziness($fuzziness = null)
	{
		$this->options[self::OPTION_FUZZINESS] = $fuzziness;

		return $this;
	}

	public function prefix_length(?int $prefix_length)
	{
		$this->options[self::OPTION_PREFIX_LENGTH] = $prefix_length;

		return $this;
	}

	public function max_expansions(?int $max_expansions)
	{
		$this->options[self::OPTION_MAX_EXPANSIONS] = $max_expansions;

		return $this;
	}
}
